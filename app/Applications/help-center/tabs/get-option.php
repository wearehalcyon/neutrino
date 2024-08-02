<h3><?php echo __('getOption'); ?></h3>
<p><?php echo __('Function returns site option value.'); ?></p>
<hr>
<p><?php echo __('<code>getOption</code> Function source code:'); ?></p>
<pre class="code">
    function getOption($name = null){
        $option = Setting::where('option_name', $name)->first();

        if ($option) {
            return $option->option_value;
        }

        return '';
    }
</pre>
<h4 style="font-size:18px;">How to use</h4>
<p><?php echo __('To output an <code>getOption</code>, use the following code anywhere in your template:'); ?></p>
<pre class="code">
    <?php echo htmlspecialchars("getOption('option_name')"); ?>
</pre>