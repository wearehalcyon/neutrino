<h3><?php echo __('getUserRole'); ?></h3>
<p><?php echo __('Function returns user role data as array.'); ?></p>
<pre>
    [
        "id" => <i>Int</i>
        "name" => <i>Str</i>  
    ]
</pre>
<hr>
<p><?php echo __('<code>getUserRole</code> Function source code:'); ?></p>
<pre class="code">
    function getUserRole($id = null){
        if ($id) {
            $user = User::find($id);
        } else {
            $user = User::find(Auth::id());
        }

        return $user->getRole();
    }
</pre>
<h4 style="font-size:18px;">How to use</h4>
<p><?php echo __('To output an <code>getUserRole</code>, use the following code anywhere in your template:'); ?></p>
<pre class="code">
    <?php echo htmlspecialchars('getUserRole($id = \'user_id\')'); ?>
</pre>