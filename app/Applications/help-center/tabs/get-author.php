<h3><?php echo __('getAuthor'); ?></h3>
<p><?php echo __('Function returns user data as array.'); ?></p>
<hr>
<p><?php echo __('<code>getAuthor</code> Function source code:'); ?></p>
<pre class="code">
    function getAuthor($id = null){
        $user = User::find($id);

        return $user;
    }
</pre>
<h4 style="font-size:18px;">How to use</h4>
<p><?php echo __('To output an <code>getAuthor</code>, use the following code anywhere in your template:'); ?></p>
<pre class="code">
    <?php echo htmlspecialchars('getAuthor($id = \'user_id\')'); ?>
</pre>