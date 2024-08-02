<h3><?php echo __('getTagLink'); ?></h3>
<p><?php echo __('Function returns base tag URL.'); ?></p>
<hr>
<p><?php echo __('<code>getTagLink</code> Function source code:'); ?></p>
<pre class="code">
    function getTagLink($slug = null){
        if ($slug) {
            $link = route('pages.blog.tag', $slug);

            if ($link) {
                return $link;
            }
        }

        return '';
    }
</pre>
<h4 style="font-size:18px;">How to use</h4>
<p><?php echo __('To output an <code>getTagLink</code>, use the following code anywhere in your template:'); ?></p>
<pre class="code">
    <?php echo htmlspecialchars('getTagLink($slug = \'tag_slug\')'); ?>
</pre>