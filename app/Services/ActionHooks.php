<?php

namespace App\Services;

class ActionHooks
{
    protected $actions = [];
    protected static $earlyActions = [];

    public function __construct()
    {
        foreach (self::$earlyActions as $hook => $callbacks) {
            foreach ($callbacks as $callback) {
                $this->addAction($hook, $callback['callback'], $callback['priority']);
            }
        }
        self::$earlyActions = []; // Очищаем ранние действия
    }

    public function addAction($hook, $callback, $priority = 10)
    {
        if (!isset($this->actions[$hook])) {
            $this->actions[$hook] = [];
        }
        $this->actions[$hook][] = ['callback' => $callback, 'priority' => $priority];
        usort($this->actions[$hook], function($a, $b) {
            return $a['priority'] <=> $b['priority'];
        });
    }

    public function doAction($hook, $args = [])
    {
        if (!isset($this->actions[$hook])) {
            return;
        }

        foreach ($this->actions[$hook] as $action) {
            call_user_func_array($action['callback'], $args);
        }
    }

    public static function addEarlyAction($hook, $callback, $priority = 10)
    {
        if (!isset(self::$earlyActions[$hook])) {
            self::$earlyActions[$hook] = [];
        }
        self::$earlyActions[$hook][] = ['callback' => $callback, 'priority' => $priority];
    }
}