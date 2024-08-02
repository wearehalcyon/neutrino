<h3><?php echo __('getUserAgent'); ?></h3>
<p><?php echo __('Function returns bool <code>true</code> or <code>false</code>.'); ?></p>
<hr>
<p><?php echo __('<code>getUserAgent</code> Function source code:'); ?></p>
<pre class="code">
    function getUserAgent($data = null, $value = null){
        if (!$data) {
            return '';
        }
        $device = Agent::device($data);
        $platform = Agent::platform($data);
        $browser = Agent::browser($data);

        if ($value == 'device') {
            if (!$device) {
                return 'Computer/Laptop';
            } else {
                return $device;
            }
        } elseif ($value == 'platform') {
            return $platform;
        } elseif ($value == 'browser') {
            return $browser;
        }
    }
</pre>
<h4 style="font-size:18px;">How to use</h4>
<p><?php echo __('To output an <code>getUserAgent</code>, use the following code anywhere in your template:'); ?></p>
<pre class="code">
    <?php echo htmlspecialchars('getUserAgent($data = \'geo_data\', $value = \'device/platform\')'); ?>
</pre>