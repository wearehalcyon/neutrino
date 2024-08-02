<h3><?php echo __('url'); ?></h3>
<p><?php echo __('Function returns full base site URL.'); ?></p>
<hr>
<p><?php echo __('<code>url</code> Function source code:'); ?></p>
<pre class="code">
    function url($args = null) {
        echo URL::current() . $args;
    }
</pre>
<h4 style="font-size:18px;">How to use</h4>
<p><?php echo __('To output an <code>url</code>, use the following code anywhere in your template:'); ?></p>
<pre class="code">
    <?php echo htmlspecialchars("url('/')"); ?>
</pre>