<h3><?php echo __('getUser'); ?></h3>
<p><?php echo __('Function returns user data as array.'); ?></p>
<pre>
    [
        "id" => <i>Int</i>
        "name" => <i>Str</i>
        "email" => <i>Str</i>
        "email_verified_at" => <i>Str</i>
        "password" => <i>Hash</i>
        "remember_token" => <i>Hash</i>
        "created_at" => <i>Timestamp</i>
        "updated_at" => <i>Timestamp</i>
        "user_id" => <i>Int</i>
        "first_name" => <i>Str</i>
        "last_name" => <i>Str</i>
        "display_name" => <i>Int</i>
        "description" => <i>Str</i>
        "birth_date" => <i>Timestamp</i>    
    ]
</pre>
<hr>
<p><?php echo __('<code>getUser</code> Function source code:'); ?></p>
<pre class="code">
    function getUser($id = null){
        $user = User::join('user_metas', 'users.id', '=', 'user_metas.user_id')
            ->where('users.id', $id)
            ->select(
                'users.*',
                'user_metas.*',
                'users.id as id',
            )
            ->first();

        return $user;
    }
</pre>
<h4 style="font-size:18px;">How to use</h4>
<p><?php echo __('To output an <code>getUser</code>, use the following code anywhere in your template:'); ?></p>
<pre class="code">
    <?php echo htmlspecialchars('getUser($id = \'user_id\')'); ?>
</pre>