<h3><?php echo __('getPostDate'); ?></h3>
<p><?php echo __('Function returns post date as string.'); ?></p>
<hr>
<p><?php echo __('<code>getPostDate</code> Function source code:'); ?></p>
<pre class="code">
    function getPostDate($format = null, $date = null){
        return date($format, strtotime($date));
    }
</pre>
<h4 style="font-size:18px;">How to use</h4>
<p><?php echo __('To output an <code>getPostDate</code>, use the following code anywhere in your template:'); ?></p>
<pre class="code">
    <?php echo htmlspecialchars('getPostDate($format = \'date_format\', $date = \'post_date\')'); ?>
</pre>