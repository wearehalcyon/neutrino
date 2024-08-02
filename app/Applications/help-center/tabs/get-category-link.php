<h3><?php echo __('getCategoryLink'); ?></h3>
<p><?php echo __('Function returns category tag URL.'); ?></p>
<hr>
<p><?php echo __('<code>getCategoryLink</code> Function source code:'); ?></p>
<pre class="code">
    function getCategoryLink($slug = null){
        if ($slug) {
            $link = route('pages.blog.category', $slug);

            if ($link) {
                return $link;
            }
        }

        return '';
    }
</pre>
<h4 style="font-size:18px;">How to use</h4>
<p><?php echo __('To output an <code>getCategoryLink</code>, use the following code anywhere in your template:'); ?></p>
<pre class="code">
    <?php echo htmlspecialchars('getCategoryLink($slug = \'tag_slug\')'); ?>
</pre>