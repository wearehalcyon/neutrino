<h3><?php echo __('getExcerpt'); ?></h3>
<p><?php echo __('Function returns trimed text as string.'); ?></p>
<hr>
<p><?php echo __('<code>getExcerpt</code> Function source code:'); ?></p>
<pre class="code">
    function getExcerpt($content = null, $limit = null, $suffix = null){
        if (!$content) {
            return '';
        }

        $clean = strip_tags($content);

        $excerpt = Str::limit($clean, $limit, $suffix);

        return $excerpt;
    }
</pre>
<h4 style="font-size:18px;">How to use</h4>
<p><?php echo __('To output an <code>getExcerpt</code>, use the following code anywhere in your template:'); ?></p>
<pre class="code">
    <?php echo htmlspecialchars('getExcerpt($content = \'content\', $limit = \'characters_limit\', $suffix = \'...\')'); ?>
</pre>