<h3><?php echo __('isMobile'); ?></h3>
<p><?php echo __('Function returns bool <code>true</code> or <code>false</code>.'); ?></p>
<hr>
<p><?php echo __('<code>isMobile</code> Function source code:'); ?></p>
<pre class="code">
    function isMobile($data = null){
        if ($data) {
            return Agent::isMobile($data);
        } else {
            return Agent::isMobile();
        }
    }
</pre>
<h4 style="font-size:18px;">How to use</h4>
<p><?php echo __('To output an <code>isMobile</code>, use the following code anywhere in your template:'); ?></p>
<pre class="code">
    <?php echo htmlspecialchars('isMobile($data = \'user_agent\')'); ?>
</pre>