<h3><?php echo __('getCategory'); ?></h3>
<p><?php echo __('Function returns category data as array.'); ?></p>
<hr>
<p><?php echo __('<code>getCategory</code> Function source code:'); ?></p>
<pre class="code">
    function getCategory($slug = null){
        $category = Category::where('slug', $slug)->first();

        if (!$category) {
            return false;
        }

        return $category;
    }
</pre>
<h4 style="font-size:18px;">How to use</h4>
<p><?php echo __('To output an <code>getCategory</code>, use the following code anywhere in your template:'); ?></p>
<pre class="code">
    <?php echo htmlspecialchars('getCategory($slug = \'category_slug\')'); ?>
</pre>