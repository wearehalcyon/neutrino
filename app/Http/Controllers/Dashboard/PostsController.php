<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ContentMeta;
use App\Models\PostToCategory;
use App\Models\PostToTag;
use App\Models\Tag;
use App\Models\User;
use App\Utils\SlugMaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    public function index(Request $request)
    {
        restrictAccess([4,5]);
        $query = Post::query();

        $routeName = Route::currentRouteName();

        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%");
                    //->orWhere('content', 'LIKE', "%{$searchTerm}%");
            });

            $posts = $query->orderBy('created_at', 'DESC')->paginate(20);
        } else {
            $posts = Post::orderBy('created_at', 'DESC')->paginate(20);
        }

        return view('dashboard.page-posts', compact('routeName', 'posts'));
    }

    public function add()
    {
        restrictAccess([4,5]);

        $routeName = Route::currentRouteName();

        $users = User::orderBy('name', 'ASC')->get();

        $categories = Category::orderBy('name', 'ASC')->get();

        return view('dashboard.page-posts-add', compact('routeName', 'users', 'categories'));
    }

    public function addSave(Request $request)
    {
        restrictAccess([4,5]);

        $baseSlug = $request->slug ? SlugMaker::slug($request->slug) : Str::slug($request->name);
        $slug = $baseSlug;
        $next = 2;

        while (Post::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $next;
            $next++;
        }

        $post = Post::create([
            'name' => $request->name,
            'slug' => $slug,
            'author_id' => $request->author_id,
            'status' => $request->status,
            'content' => $request->content,
            'delayed_date' => $request->delayed_date,
        ]);

        // Add categories
        if ($request->category_id) {
            foreach ($request->category_id as $category_id) {
                PostToCategory::create([
                    'post_id' => $post->id,
                    'category_id' => $category_id,
                ]);
            }
        }

        // Add tags
        if ($request->tags) {
            foreach ($request->tags as $tag) {
                if (!(int)$tag) {
                    $tagSlug = Str::slug($tag);
                    $next = 2;

                    while (Tag::where('slug', $slug)->exists()) {
                        $tagSlug = $tagSlug . '-' . $next;
                        $next++;
                    }

                    $newTag = Tag::create([
                        'name' => $tag,
                        'slug' => $tagSlug,
                        'author_id' => Auth::id()
                    ]);

                    PostToTag::create([
                        'post_id' => $post->id,
                        'tag_id' => $newTag->id
                    ]);
                } else {
                    PostToTag::create([
                        'post_id' => $post->id,
                        'tag_id' => $tag
                    ]);
                }
            }
        }

        // Upload thumbnail to the public/uploads/ID path
        if ($request->hasFile('thumbnail_file')) {
            $file = $request->file('thumbnail_file');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('uploads/'), $fileName);
            $post->thumbnail = 'uploads/' . $request->thumbnail;
            $post->save();
        }

        // Add SEO meta fields
        if ($request->seo_title) {
            ContentMeta::create([
                'post_id' => $post->id,
                'meta_key' => 'seo_title',
                'meta_value' => $request->seo_title,
                'type' => $post->type()
            ]);
        }
        if ($request->seo_slug) {
            ContentMeta::create([
                'post_id' => $post->id,
                'meta_key' => 'seo_slug',
                'meta_value' => $request->seo_slug,
                'type' => $post->type()
            ]);
        }
        if ($request->meta_description) {
            ContentMeta::create([
                'post_id' => $post->id,
                'meta_key' => 'meta_description',
                'meta_value' => $request->meta_description,
                'type' => $post->type()
            ]);
        }

        return redirect()->route('dash.posts.edit', $post->id)->with('success', __('Post was created successfully!'));
    }

    public function edit($id)
    {
        restrictAccess([4,5]);

        $routeName = Route::currentRouteName();

        $categories = Category::orderBy('name', 'ASC')->get();
        $tags = PostToTag::join('tags', 'post_to_tags.tag_id', '=', 'tags.id')
            ->where('post_to_tags.post_id', $id)
            ->select('tags.*')
            ->get();
        $users = User::orderBy('name', 'ASC')->get();
        $post = Post::find($id);

        if ($post->delayed_date) {
            $delay = date('Y-m-d\TH:i:s', strtotime($post->delayed_date));
        } else {
            $delay = null;
        }

        return view('dashboard.page-posts-edit', compact('routeName', 'categories', 'tags', 'users', 'post', 'delay'));
    }

    public function editSave(Request $request, $id)
    {
        restrictAccess([4,5]);

        $baseSlug = $request->slug ? SlugMaker::slug($request->slug) : Str::slug($request->name);
        $slug = $baseSlug;
        $next = 2;

        $existingPages = Post::where('slug', 'like', $slug . '%')
            ->where('id', '<>', $id)
            ->get();

        if ($existingPages->count() > 0) {
            while (Post::where('slug', $slug)->where('id', '<>', $id)->exists()) {
                $slug = $baseSlug . '-' . $next;
                $next++;
            }
        }

        $post = Post::find($id);
        $post->name = $request->name;
        $post->content = $request->content;
        $post->author_id = $request->author_id;
        $post->slug = $slug;
        $post->content = $request->content;
        $post->status = $request->status;
        $post->delayed_date = $request->delayed_date;
        $post->created_at = $request->created_at;
        $post->save();

        // Update categories
        if ($request->has('category_id')) {
            $newCategoryIds = $request->category_id;
            $currentCategoryIds = $post->categories()->pluck('category_id')->toArray();
            $categoriesToAdd = array_diff($newCategoryIds, $currentCategoryIds);
            $categoriesToRemove = array_diff($currentCategoryIds, $newCategoryIds);

            foreach ($categoriesToAdd as $categoryId) {
                PostToCategory::create([
                    'post_id' => $post->id,
                    'category_id' => $categoryId,
                ]);
            }

            PostToCategory::where('post_id', $post->id)
                ->whereIn('category_id', $categoriesToRemove)
                ->delete();
        } else {
            PostToCategory::where('post_id', $post->id)->delete();
        }

        // Update categories
        if ($request->has('tags')) {
            $newTagIds = $request->tags;
            $currentTagIds = $post->tags()->pluck('tag_id')->toArray();
            $tagsToAdd = array_diff($newTagIds, $currentTagIds);
            $tagsToRemove = array_diff($currentTagIds, $newTagIds);

            foreach ($tagsToAdd as $tagId) {
//                PostToTag::create([
//                    'post_id' => $post->id,
//                    'tag_id' => $tagId,
//                ]);
                if (!(int)$tagId) {
                    $tagSlug = Str::slug($tagId);
                    $next = 2;

                    while (Tag::where('slug', $slug)->exists()) {
                        $tagSlug = $tagSlug . '-' . $next;
                        $next++;
                    }

                    $newTag = Tag::create([
                        'name' => $tagId,
                        'slug' => $tagSlug,
                        'author_id' => Auth::id()
                    ]);

                    PostToTag::create([
                        'post_id' => $post->id,
                        'tag_id' => $newTag->id
                    ]);
                } else {
                    PostToTag::create([
                        'post_id' => $post->id,
                        'tag_id' => $tagId
                    ]);
                }
            }

            PostToTag::where('post_id', $post->id)
                ->whereIn('tag_id', $tagsToRemove)
                ->delete();
        } else {
            PostToTag::where('post_id', $post->id)->delete();
        }

        // Upload thumbnail to the public/uploads/ID path
        if ($request->hasFile('thumbnail_file')) {
            $file = $request->file('thumbnail_file');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('uploads/'), $fileName);
            $post->thumbnail = 'uploads/' . $request->thumbnail;
            $post->save();
        }

        if (!$request->thumbnail) {
            $post->thumbnail = null;
            $post->save();
        }

        // Update SEO meta fields
        $seo_title = ContentMeta::where([
            'post_id' => $id,
            'meta_key' => 'seo_title'
        ])->first();
        if ($seo_title) {
            $seo_title->meta_value = $request->seo_title;
            $seo_title->type = $post->type();
            $seo_title->save();
        } else {
            ContentMeta::create([
                'post_id' => $id,
                'meta_key' => 'seo_title',
                'meta_value' => $request->seo_title,
                'type' => $post->type()
            ]);
        }
        $seo_slug = ContentMeta::where([
            'post_id' => $id,
            'meta_key' => 'seo_slug'
        ])->first();
        if ($seo_slug) {
            $seo_slug->meta_value = $request->seo_slug;
            $seo_slug->type = $post->type();
            $seo_slug->save();
        } else {
            ContentMeta::create([
                'post_id' => $id,
                'meta_key' => 'seo_slug',
                'meta_value' => $request->seo_slug,
                'type' => $post->type()
            ]);
        }
        $meta_description = ContentMeta::where([
            'post_id' => $id,
            'meta_key' => 'meta_description'
        ])->first();
        if ($meta_description) {
            $meta_description->meta_value = $request->meta_description;
            $meta_description->type = $post->type();
            $meta_description->save();
        } else {
            ContentMeta::create([
                'post_id' => $id,
                'meta_key' => 'meta_description',
                'meta_value' => $request->meta_description,
                'type' => $post->type()
            ]);
        }

        return redirect()->back()->with('success', __('Post was updated successfully!'));
    }

    public function delete($id)
    {
        restrictAccess([4,5]);

        Post::find($id)->delete();

        return redirect()->route('dash.posts')->with('success', __('Post was deleted successfully!'));
    }

    public function duplicate($id)
    {
        restrictAccess([4,5]);

        $post = Post::find($id);

        $name = $post->name;
        $slug = $post->slug;
        $next = 2;
        $next2 = 2;

        while (Post::where('slug', $slug)->exists()) {
            $name = $name . ' ' . $next;
            $slug = $slug . '-' . $next2;
            $next++;
            $next2++;
        }

        $newPost = Post::create([
            'name' => $name,
            'slug' => $slug,
            'author_id' => $post->author_id,
            'status' => $post->status,
            'content' => $post->content,
            'delayed_date' => $post->delayed_date,
            'thumbnail' => $post->thumbnail
        ]);

        $categories = PostToCategory::join('categories', 'post_to_categories.category_id', '=', 'categories.id')
            ->where('post_to_categories.post_id', $post->id)
            ->select('categories.*')
            ->get();
        foreach ($categories as $category){
            PostToCategory::create([
                'post_id' => $newPost->id,
                'category_id' => $category->id
            ]);
        }

        $tags = PostToTag::join('tags', 'post_to_tags.tag_id', '=', 'tags.id')
            ->where('post_to_tags.post_id', $post->id)
            ->select('tags.*')
            ->get();
        foreach ($tags as $tag){
            PostToTag::create([
                'post_id' => $newPost->id,
                'tag_id' => $tag->id
            ]);
        }

        $postMetas = ContentMeta::where([
            'post_id' => $post->id,
            'type' => 'post'
        ])->get();
        foreach ($postMetas as $postMeta) {
            ContentMeta::create([
                'page_id' => null,
                'post_id' => $newPost->id,
                'category_id' => null,
                'tag_id' => null,
                'type' => $newPost->type(),
                'meta_key' => $postMeta->meta_key,
                'meta_value' => $postMeta->meta_value,
            ]);
        }

        return redirect()->back()->with('success', __('Post was duplicated successfully'));
    }

    public function quickActions(Request $request)
    {
        restrictAccess([4,5]);

        $action = $request->query('action');
        $ids = $request->query('selects', []);

        if ($action == 1) {
            foreach ($ids as $id) {
                $post = Post::find($id);
                if ($post->status == 1) {
                    $post->status = 2;
                } else {
                    $post->status = 1;
                }
                $post->save();
            }
        } elseif ($action == 2) {
            foreach ($ids as $id) {
                $post = Post::find($id);

                $name = $post->name;
                $slug = $post->slug;
                $next = 2;
                $next2 = 2;

                while (Post::where('slug', $slug)->exists()) {
                    $name = $name . ' ' . $next;
                    $slug = $slug . '-' . $next2;
                    $next++;
                    $next2++;
                }

                $newPost = Post::create([
                    'name' => $name,
                    'slug' => $slug,
                    'author_id' => $post->author_id,
                    'status' => $post->status,
                    'content' => $post->content,
                    'delayed_date' => $post->delayed_date,
                    'thumbnail' => $post->thumbnail
                ]);

                $categories = PostToCategory::join('categories', 'post_to_categories.category_id', '=', 'categories.id')
                    ->where('post_to_categories.post_id', $post->id)
                    ->select('categories.*')
                    ->get();
                foreach ($categories as $category){
                    PostToCategory::create([
                        'post_id' => $newPost->id,
                        'category_id' => $category->id
                    ]);
                }

                $tags = PostToTag::join('tags', 'post_to_tags.tag_id', '=', 'tags.id')
                    ->where('post_to_tags.post_id', $post->id)
                    ->select('tags.*')
                    ->get();
                foreach ($tags as $tag){
                    PostToTag::create([
                        'post_id' => $newPost->id,
                        'tag_id' => $tag->id
                    ]);
                }

                $postMetas = ContentMeta::where([
                    'post_id' => $post->id,
                    'type' => 'post'
                ])->get();
                foreach ($postMetas as $postMeta) {
                    ContentMeta::create([
                        'page_id' => null,
                        'post_id' => $newPost->id,
                        'category_id' => null,
                        'tag_id' => null,
                        'type' => $newPost->type(),
                        'meta_key' => $postMeta->meta_key,
                        'meta_value' => $postMeta->meta_value,
                    ]);
                }
            }
        } elseif ($action == 3) {
            foreach ($ids as $id) {
                Post::find($id)->delete();
            }
        }

        return redirect()->back()->with('success', __('Posts bulk actions was completed successfully'));
    }
}
