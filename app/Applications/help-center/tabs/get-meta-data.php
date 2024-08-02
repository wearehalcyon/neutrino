<h3><?php echo __('getMetaData'); ?></h3>
<p><?php echo __('Function returns post or page meta data value.'); ?></p>
<hr>
<p><?php echo __('<code>getMetaData</code> Function source code:'); ?></p>
<pre class="code">
    function getMetaData($type = null, $id = null, $key = null){
        $args = [
            'type' => $type,
            $type . '_id' => $id,
            'meta_key' => $key,
        ];
        $data = ContentMeta::where($args)->first();

        return optional($data)->meta_value;
    }
</pre>
<h4 style="font-size:18px;">How to use</h4>
<p><?php echo __('To output an <code>getMetaData</code>, use the following code anywhere in your template:'); ?></p>
<pre class="code">
    <?php echo htmlspecialchars('getMetaData($type = \'post/page\', $id = \'post/page_id\', $key = \'meta_key\')'); ?>
</pre>