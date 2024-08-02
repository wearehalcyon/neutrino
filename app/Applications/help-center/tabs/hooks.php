<h3><?php echo __('System Hooks'); ?></h3>
<p><?php echo __('In this section, you can familiarize yourself with the hooks system (actions and filters). If you\'ve worked with WordPress, you should understand the basic concept. However, we offer a slightly different approach:'); ?></p>
<hr>
<h4><?php echo __('Actions'); ?></h4>
<p><?php echo __('<code>doAction</code> Function source code:'); ?></p>
<pre class="code">
    function doAction($hook, $args = []){
        app(ActionHooks::class)->doAction($hook, $args);
    }
</pre>
<p><?php echo __('<code>ActionHooks</code> Class source code:'); ?></p>
<pre class="code">
    function doAction($hook, $args = []){
        app(ActionHooks::class)->doAction($hook, $args);
    }
</pre>
<h4 style="font-size:18px;">How to use actions</h4>
<p><?php echo __('To output an action, use the following code anywhere in your template:'); ?></p>
<pre class="code">
    <?php echo htmlspecialchars("doAction('my_action')"); ?>
</pre>
<p><?php echo __('So if you are using blade syntax just use:'); ?></p>
<pre class="code">
    <?php echo htmlspecialchars("@php
        doAction('my_action')
    @endphp"); ?>
</pre>
<p><?php echo __('If pure PHP syntax:'); ?></p>
<pre class="code">
    <?php echo htmlspecialchars("<?php echo doAction('my_action'); ?>"); ?>
</pre>