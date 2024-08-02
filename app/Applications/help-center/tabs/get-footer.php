<h3><?php echo __('getFooter'); ?></h3>
<p><?php echo __('Function returns base template scripts in footer. Important to initialization admin bar. Should be placed before closing <code>' . htmlspecialchars("</body>") . '</code> tag.'); ?></p>
<hr>
<p><?php echo __('<code>getFooter</code> Function source code:'); ?></p>
<pre class="code">
    function getFooter(){
        echo '<script id="nt-base-jquery-script" src="' . asset('assets/js/core/jquery-3.7.1.min.js') . '"></script>';
        echo getOption('footer_scripts');
    }
</pre>
<h4 style="font-size:18px;">How to use</h4>
<p><?php echo __('To output an <code>getFooter</code>, use the following code anywhere in your template:'); ?></p>
<pre class="code">
    <?php echo htmlspecialchars('getFooter()'); ?>
</pre>