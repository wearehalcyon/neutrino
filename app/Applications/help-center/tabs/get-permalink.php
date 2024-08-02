<h3><?php echo __('getPermalink'); ?></h3>
<p><?php echo __('Function returns base post or page URL.'); ?></p>
<hr>
<p><?php echo __('<code>getPermalink</code> Function source code:'); ?></p>
<pre class="code">
    function getPermalink($type = null, $id = null){
        if ($type && $id) {
            if ($type == 'page') {
                $page = Page::find($id);
                return url('/' . optional($page)->slug);
            }
            if ($type == 'post') {
                $post = Post::find($id);
                return url('/' . getOption('blog_base') . '/' . optional($post)->slug);
            }
        }

        return '';
    }
</pre>
<h4 style="font-size:18px;">How to use</h4>
<p><?php echo __('To output an <code>getPermalink</code>, use the following code anywhere in your template:'); ?></p>
<pre class="code">
    <?php echo htmlspecialchars('getPermalink($type = \'post/page\', $id = \'id\')'); ?>
</pre>