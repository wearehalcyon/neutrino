<h3><?php echo __('getGeoIp'); ?></h3>
<p><?php echo __('Function returns location data as array.'); ?></p>
<hr>
<p><?php echo __('<code>getGeoIp</code> Function source code:'); ?></p>
<pre class="code">
    function getGeoIp($ip = null){
        $location = Location::get($ip);
        if (!$location) {
            return false;
        }
        $location = collect($location);
        return $location;
    }
</pre>
<h4 style="font-size:18px;">How to use</h4>
<p><?php echo __('To output an <code>getGeoIp</code>, use the following code anywhere in your template:'); ?></p>
<pre class="code">
    <?php echo htmlspecialchars('getGeoIp($ip = \'ip_address\')'); ?>
</pre>