<h3><?php echo __('getThemeAssetsUri'); ?></h3>
<p><?php echo __('Function returns base theme URL.'); ?></p>
<hr>
<p><?php echo __('<code>getThemeAssetsUri</code> Function source code:'); ?></p>
<pre class="code">
    function getThemeAssetsUri($suffix = null){
        return url('/themes/' . getOption('front_theme') . $suffix);
    }
</pre>
<h4 style="font-size:18px;">How to use</h4>
<p><?php echo __('To output an <code>getThemeAssetsUri</code>, use the following code anywhere in your template:'); ?></p>
<pre class="code">
    <?php echo htmlspecialchars('getThemeAssetsUri($suffix = \'/my-theme/style.css\')'); ?>
</pre>
<p><?php echo __('Return: '); ?><code>https://mysite.com/themes/my-theme/style.css</code></p>