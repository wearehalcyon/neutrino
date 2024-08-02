<h3><?php echo __('getBodyClass'); ?></h3>
<p><?php echo __('Function returns string with default body classes. Can be added custom classes. Displayed in class attribute of <code>' . htmlspecialchars('<body>') . '</code> tag.'); ?></p>
<hr>
<p><?php echo __('<code>getBodyClass</code> Function source code:'); ?></p>
<pre class="code">
    function getBodyClass($custom_classes = null){
        if (Auth::user()) {
            $classes = 'body-class launched admin-bar ' . $custom_classes;
        } else {
            $classes = 'body-class launched ' . $custom_classes;
        }

        return $classes;
    }
</pre>
<h4 style="font-size:18px;">How to use</h4>
<p><?php echo __('To output an <code>getBodyClass</code>, use the following code anywhere in your template:'); ?></p>
<pre class="code">
    <?php echo htmlspecialchars('getBodyClass($custom_classes = \'my_body_class my_body_class_second\')'); ?>
</pre>