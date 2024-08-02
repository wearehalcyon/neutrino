<h3><?php echo __('getPage'); ?></h3>
<p><?php echo __('Function returns page data as array.'); ?></p>
<hr>
<p><?php echo __('<code>getPage</code> Function source code:'); ?></p>
<pre class="code">
    function getPage($slug = null){
        $page = Page::where('slug', $slug)->first();

        if (!$page) {
            return false;
        }

        return $page;
    }
</pre>
<h4 style="font-size:18px;">How to use</h4>
<p><?php echo __('To output an <code>getPage</code>, use the following code anywhere in your template:'); ?></p>
<pre class="code">
    <?php echo htmlspecialchars('getPage($slug = \'page_slug\')'); ?>
</pre>