<h3><?php echo __('getPosts'); ?></h3>
<p><?php echo __('Function returns posts as array.'); ?></p>
<hr>
<p><?php echo __('<code>getPosts</code> Function source code:'); ?></p>
<pre class="code">
    function getPosts($category = null, $orderby = 'created_at', $order = 'ASC', $limit = null){
        if ($limit) {
            $limit = $limit;
        } else {
            $limit = getOption('posts_per_page');
        }
        if ($category) {
            $posts = Post::orderBy($orderby, $order)->paginate($limit);
        } else {
            $posts = Post::orderBy($orderby, $order)->paginate($limit);
        }

        return $posts;
    }
</pre>
<h4 style="font-size:18px;">How to use</h4>
<p><?php echo __('To output an <code>getPosts</code>, use the following code anywhere in your template:'); ?></p>
<pre class="code">
    <?php echo htmlspecialchars('getPosts($category = \'category_id\', $orderby = \'order_by\', $order = \'ASC/DESC\', $limit = \'posts_per_page\')'); ?>
</pre>