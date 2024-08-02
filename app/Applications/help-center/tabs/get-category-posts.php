<h3><?php echo __('getCategoryPosts'); ?></h3>
<p><?php echo __('Function returns category posts as array.'); ?></p>
<hr>
<p><?php echo __('<code>getCategoryPosts</code> Function source code:'); ?></p>
<pre class="code">
    function getCategoryPosts($id = null, $excluded = null, $doubles = [], $orderby = 'created_at', $order = 'ASC', $limit = null){
        if ($orderby == 'random') {
            $posts = Post::join('post_to_categories', 'posts.id', '=', 'post_to_categories.post_id')
                ->where('post_to_categories.category_id', $id)
                ->where('posts.id', '!=', $excluded)
                ->whereNotIn('posts.id', $doubles)
                ->select('posts.*')
                ->distinct()
                ->inRandomOrder()
                ->paginate($limit);
        } else {
            $posts = Post::join('post_to_categories', 'posts.id', '=', 'post_to_categories.post_id')
                ->where('post_to_categories.category_id', $id)
                ->where('posts.id', '!=', $excluded)
                ->whereNotIn('posts.id', $doubles)
                ->select('posts.*')
                ->distinct()
                ->orderBy('posts.' . $orderby, $order)
                ->paginate($limit);
        }

        if ($posts) {
            return $posts;
        }

        return '';
    }
</pre>
<h4 style="font-size:18px;">How to use</h4>
<p><?php echo __('To output an <code>getCategoryPosts</code>, use the following code anywhere in your template:'); ?></p>
<pre class="code">
    <?php echo htmlspecialchars('getCategoryPosts($id = \'category_id\', $excluded = \'excluded_posts_id_array\', $doubles = \'posts_as_doubles_array_ids\', $orderby = \'order_by\', $order = \'order\', $limit = \'posts_per_page\')'); ?>
</pre>