<?php

namespace App\Services;

class ActionHooks
{
    protected $actions = [];
    protected static $earlyActions = [];
    
    protected $filters = [];
    protected static $earlyFilters = [];

    public function __construct()
    {
        // Инициализация ранних экшенов
        foreach (self::$earlyActions as $hook => $callbacks) {
            foreach ($callbacks as $callback) {
                $this->addAction($hook, $callback['callback'], $callback['priority']);
            }
        }
        self::$earlyActions = [];

        // Инициализация ранних фильтров
        foreach (self::$earlyFilters as $hook => $callbacks) {
            foreach ($callbacks as $callback) {
                $this->addFilter($hook, $callback['callback'], $callback['priority']);
            }
        }
        self::$earlyFilters = [];
    }

    // Методы для экшенов
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

    // Методы для фильтров
    public function addFilter($hook, $callback, $priority = 10)
    {
        if (!isset($this->filters[$hook])) {
            $this->filters[$hook] = [];
        }
        $this->filters[$hook][] = ['callback' => $callback, 'priority' => $priority];
        usort($this->filters[$hook], function($a, $b) {
            return $a['priority'] <=> $b['priority'];
        });
    }

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
}