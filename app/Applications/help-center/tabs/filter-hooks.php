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

<div id="add-filter" style="margin-top: 80px;">
    <h4><?php echo __('addFilter'); ?></h4>
    <p><?php echo __('This function will provide you to register/init hook for <code>addFilter</code> point.'); ?></p>
    <p><?php echo __('<code>addFilter</code> Function source code:'); ?></p>
    <pre class="code">
        function addFilter($hook, $callback, $priority = 1){
            if (app()->bound(ActionHooks::class)) {
                app(ActionHooks::class)->addFilter($hook, $callback, $priority);
            } else {
                ActionHooks::addEarlyFilter($hook, $callback, $priority);
            }
        }
    </pre>
    <p><?php echo __('<code>ActionHooks</code> Class source code:'); ?></p>
    <pre class="code">
        public function addFilter($hook, $callback, $priority = 1){
            if (!isset($this->filters[$hook])) {
                $this->filters[$hook] = [];
            }
            $this->filters[$hook][] = ['callback' => $callback, 'priority' => $priority];
            usort($this->filters[$hook], function($a, $b) {
                return $a['priority'] <=> $b['priority'];
            });
        }
    </pre>
    <h4 style="font-size:18px;">How to use <code>addFilter</code></h4>
    <p>
        <ul>
            <li><strong><?php echo __('Arguments:'); ?></strong></li>
            <li><code>$hook</code> - <?php echo __("<i>String</i> | Should be a name of hook, for example <strong>'my_filter'</strong>"); ?></li>
            <li><code>$callback</code> - <?php echo __("<i>Function</i> | Should be a PHP function"); ?></li>
            <li><code>$priority</code> - <?php echo __("<i>Int</i> | Should be a number of displaying position, default is - 1"); ?></li>
            <li><code>$content</code> - <?php echo __("This is the content that will be overridden by the filter - required"); ?></li>
        </ul>
    </p>
    <p><?php echo __('To output an <code>addFilter</code>, use the following code anywhere in your template:'); ?></p>
    <pre class="code">
        <?php echo htmlspecialchars('addFilter($hook = \'my_filter\', $callback = function($content) {
            return \'Hello, world!\';
        }, $priority = 10)'); ?>
    </pre>
</div>