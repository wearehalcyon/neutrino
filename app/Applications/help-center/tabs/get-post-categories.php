<h3><?php echo __('getPostCategories'); ?></h3>
<p><?php echo __('Function returns post categories as array.'); ?></p>
<hr>
<p><?php echo __('<code>getPostCategories</code> Function source code:'); ?></p>
<pre class="code">
    function getPostCategories($id = null){
        $categories = Category::join('post_to_categories', 'categories.id', '=', 'post_to_categories.category_id')
            ->where('post_to_categories.post_id', $id)
            ->select('categories.*')
            ->get();

        if ($categories) {
            return $categories;
        }

        return '';
    }
</pre>
<h4 style="font-size:18px;">How to use</h4>
<p><?php echo __('To output an <code>getPostCategories</code>, use the following code anywhere in your template:'); ?></p>
<pre class="code">
    <?php echo htmlspecialchars('getPostCategories($id = \'post_id\')'); ?>
</pre>