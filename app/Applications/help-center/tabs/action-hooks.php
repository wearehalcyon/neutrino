<h3><?php echo __('System Action Hooks'); ?></h3>
<p><?php echo __('In this section, you can familiarize yourself with the action hooks system. If you\'ve worked with WordPress, you should understand the basic concept. However, we offer a slightly different approach:'); ?></p>
<ul>
    <li>- <a href="#do-action">doAction</a></li>
    <li>- <a href="#add-action">addAction</a></li>
</ul>
<hr>
<div id="do-action">
    <h4><?php echo __('doAction'); ?></h4>
    <p><?php echo __('This function will create hook point in anywehere you want of your templates.'); ?></p>
    <p><?php echo __('<code>doAction</code> Function source code:'); ?></p>
    <pre class="code">
        function doAction($hook, $args = []){
            app(ActionHooks::class)->doAction($hook, $args);
        }
    </pre>
    <p><?php echo __('<code>ActionHooks</code> Class source code:'); ?></p>
    <pre class="code">
        public function doAction($hook, $args = []){
            if (!isset($this->actions[$hook])) {
                return;
            }

            foreach ($this->actions[$hook] as $action) {
                call_user_func_array($action['callback'], $args);
            }
        }

        public static function addEarlyAction($hook, $callback, $priority = 1){
            if (!isset(self::$earlyActions[$hook])) {
                self::$earlyActions[$hook] = [];
            }
            self::$earlyActions[$hook][] = ['callback' => $callback, 'priority' => $priority];
        }
    </pre>
    <h4 style="font-size:18px;">How to use <code>doAction</code></h4>
    <p><?php echo __('To output an <code>doAction</code>, use the following code anywhere in your template:'); ?></p>
    <pre class="code">
        <?php echo htmlspecialchars("doAction('my_action')
        
        // Or echo string
        {{ doAction('my_action') }}
         
        // Or echo html
        {!! doAction('my_action') !!}"); ?>
    </pre>
    <p><?php echo __('So if you are using blade syntax just use:'); ?></p>
    <pre class="code">
        <?php echo htmlspecialchars("@php
            doAction('my_action')
        @endphp"); ?>
    </pre>
    <p><?php echo __('If pure PHP syntax:'); ?></p>
    <pre class="code">
        <?php echo htmlspecialchars("<?php echo doAction('my_action'); ?>"); ?>
    </pre>
</div>

<div id="add-action" style="margin-top: 80px;">
    <h4><?php echo __('addAction'); ?></h4>
    <p><?php echo __('This function will provide you to register/init hook for <code>doAction</code> point.'); ?></p>
    <p><?php echo __('<code>addAction</code> Function source code:'); ?></p>
    <p>
        <ul>
            <li><strong><?php echo __('Arguments:'); ?></strong></li>
            <li><code>$hook</code> - <?php echo __("<i>String</i> | Should be a name of hook, for example <strong>'my_hook'</strong>"); ?></li>
            <li><code>$callback</code> - <?php echo __("<i>Function</i> | Should be a PHP function"); ?></li>
            <li><code>$priority</code> - <?php echo __("<i>Int</i> | Should be a number of displaying position, default is - 1"); ?></li>
        </ul>
    </p>
    <pre class="code">
        function addAction($hook, $callback, $priority = 1){
            if (app()->bound(ActionHooks::class)) {
                app(ActionHooks::class)->addAction($hook, $callback, $priority);
            } else {
                ActionHooks::addEarlyAction($hook, $callback, $priority);
            }
        }
    </pre>
    <p><?php echo __('<code>ActionHooks</code> Class source code:'); ?></p>
    <pre class="code">
        public function addAction($hook, $callback, $priority = 1){
            if (!isset($this->actions[$hook])) {
                $this->actions[$hook] = [];
            }
            $this->actions[$hook][] = ['callback' => $callback, 'priority' => $priority];
            usort($this->actions[$hook], function($a, $b) {
                return $a['priority'] <=> $b['priority'];
            });
        }
    </pre>
    <h4 style="font-size:18px;">How to use <code>addAction</code></h4>
    <p><?php echo __('To output an <code>addAction</code>, use the following code anywhere in your template:'); ?></p>
    <pre class="code">
        <?php echo htmlspecialchars("addAction('my_action', function(){
            echo 'Hello, world!';
        }, 10)"); ?>
    </pre>
</div>