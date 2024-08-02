<h3><?php echo __('System Filter Hooks'); ?></h3>
<p><?php echo __('In this section, you can familiarize yourself with the filter hooks system. If you\'ve worked with WordPress, you should understand the basic concept. However, we offer a slightly different approach:'); ?></p>
<ul>
    <li>- <a href="#apply-filter">applyFilter</a></li>
    <li>- <a href="#add-filter">addFilter</a></li>
</ul>
<hr>
<div id="apply-filter">
    <h4><?php echo __('applyFilter'); ?></h4>
    <p><?php echo __('This function will create hook point in anywehere you want of your templates.'); ?></p>
    <p><?php echo __('<code>applyFilter</code> Function source code:'); ?></p>
    <pre class="code">
        function applyFilter($hook, $value, $args = []){
            return app(ActionHooks::class)->applyFilter($hook, $value, $args);
        }
    </pre>
    <p><?php echo __('<code>ActionHooks</code> Class source code:'); ?></p>
    <pre class="code">
        public function applyFilter($hook, $value, $args = [])
        {
            if (!isset($this->filters[$hook])) {
                return $value;
            }

            foreach ($this->filters[$hook] as $filter) {
                $value = call_user_func_array($filter['callback'], array_merge([$value], $args));
            }

            return $value;
        }

        public static function addEarlyFilter($hook, $callback, $priority = 10)
        {
            if (!isset(self::$earlyFilters[$hook])) {
                self::$earlyFilters[$hook] = [];
            }
            self::$earlyFilters[$hook][] = ['callback' => $callback, 'priority' => $priority];
        }
    </pre>
    <h4 style="font-size:18px;">How to use <code>applyFilter</code></h4>
    <p><?php echo __('To output an <code>applyFilter</code>, use the following code anywhere in your template:'); ?></p>
    <pre class="code">
        <?php echo 'applyFilter(\'my_filter\', $content)'; ?>
    </pre>
    <p><?php echo __('So if you are using blade syntax just use:'); ?></p>
    <pre class="code">
        <?php echo htmlspecialchars('@php
            applyFilter(\'my_filter\', $content)
        @endphp'); ?>
    </pre>
    <p><?php echo __('If pure PHP syntax:'); ?></p>
    <pre class="code">
        <?php echo htmlspecialchars('<?php echo applyFilter(\'my_filter\', $content); ?>'); ?>
    </pre>
</div>