<h3><?php echo __('getTagPosts'); ?></h3>
<p><?php echo __('Function returns tag posts as array.'); ?></p>
<hr>
<p><?php echo __('<code>getTagPosts</code> Function source code:'); ?></p>
<pre class="code">
    function getTagPosts($id = null, $orderby = 'created_at', $order = 'ASC', $limit = null){
        if ($orderby == 'random') {
            $posts = Post::join('post_to_tags', 'posts.id', '=', 'post_to_tags.post_id')
                ->where('post_to_tags.tag_id', $id)
                ->select('posts.*')
                ->inRandomOrder()
                ->paginate($limit);
        } else {
            $posts = Post::join('post_to_tags', 'posts.id', '=', 'post_to_tags.post_id')
                ->where('post_to_tags.tag_id', $id)
                ->select('posts.*')
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
<p><?php echo __('To output an <code>getTagPosts</code>, use the following code anywhere in your template:'); ?></p>
<pre class="code">
    <?php echo htmlspecialchars('getTagPosts($id = \'tag_id\', $orderby = \'order_by\', $order = \'order\', $limit = \'posts_per_page\')'); ?>
</pre>