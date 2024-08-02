<h3><?php echo __('hideAccess'); ?></h3>
<p><?php echo __('Function returns bool <code>true</code> or <code>false</code>.'); ?></p>
<hr>
<p><?php echo __('<code>getUserRole</code> Function source code:'); ?></p>
<pre class="code">
    function hideAccess($array = null){
        if (in_array(getUserRole()->id, $array)) {
            return false;
        }

        return true;
    }
</pre>
<h4 style="font-size:18px;">How to use</h4>
<p><?php echo __('To output an <code>hideAccess</code>, use the following code anywhere in your template:'); ?></p>
<pre class="code">
    <?php echo htmlspecialchars('hideAccess($array = \'[1,2,3,4,5]\')'); ?>
</pre>