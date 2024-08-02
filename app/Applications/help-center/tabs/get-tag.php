<h3><?php echo __('getTag'); ?></h3>
<p><?php echo __('Function returns tag data as array.'); ?></p>
<hr>
<p><?php echo __('<code>getTag</code> Function source code:'); ?></p>
<pre class="code">
    function getTag($slug = null){
        $tag = Tag::where('slug', $slug)->first();

        if (!$tag) {
            return false;
        }

        return $tag;
    }
</pre>
<h4 style="font-size:18px;">How to use</h4>
<p><?php echo __('To output an <code>getTag</code>, use the following code anywhere in your template:'); ?></p>
<pre class="code">
    <?php echo htmlspecialchars('getTag($slug = \'tag_slug\')'); ?>
</pre>