<h3><?php echo __('restrictAccess'); ?></h3>
<p><?php echo __('Function returns view page or 404 error code page.'); ?></p>
<hr>
<p><?php echo __('<code>getUserRole</code> Function source code:'); ?></p>
<pre class="code">
    function restrictAccess($array = null){
        if (in_array(getUserRole()->id, $array)) {
            abort(404);
        }
    }
</pre>
<h4 style="font-size:18px;">How to use</h4>
<p><?php echo __('To output an <code>restrictAccess</code>, use the following code anywhere in your template:'); ?></p>
<pre class="code">
    <?php echo htmlspecialchars('restrictAccess($array = \'[1,2,3,4,5]\')'); ?>
</pre>