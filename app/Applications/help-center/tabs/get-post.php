<h3><?php echo __('getPost'); ?></h3>
<p><?php echo __('Function returns post data as array.'); ?></p>
<hr>
<p><?php echo __('<code>getPost</code> Function source code:'); ?></p>
<pre class="code">
    function getPost($slug = null){
        $post = Post::where('slug', $slug)->first();

        if (!$post) {
            return false;
        }

        return $post;
    }
</pre>
<h4 style="font-size:18px;">How to use</h4>
<p><?php echo __('To output an <code>getPost</code>, use the following code anywhere in your template:'); ?></p>
<pre class="code">
    <?php echo htmlspecialchars('getPost($slug = \'post_slug\')'); ?>
</pre>