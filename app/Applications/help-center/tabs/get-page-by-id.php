<h3><?php echo __('getPageByID'); ?></h3>
<p><?php echo __('Function returns page data as array. Requesting by page ID.'); ?></p>
<hr>
<p><?php echo __('<code>getPageByID</code> Function source code:'); ?></p>
<pre class="code">
    function getPageByID($id = null){
        $page = Page::find($id);

        if (!$page) {
            return false;
        }

        return $page;
    }
</pre>
<h4 style="font-size:18px;">How to use</h4>
<p><?php echo __('To output an <code>getPageByID</code>, use the following code anywhere in your template:'); ?></p>
<pre class="code">
    <?php echo htmlspecialchars('getPageByID($id = \'page_id\')'); ?>
</pre>