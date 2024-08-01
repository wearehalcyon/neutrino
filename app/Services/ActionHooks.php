<?php

namespace App\Services;

class ActionHooks
{
    protected $actions = [];

    public function addAction($hook, $callback, $priority = 10)
    {
        $this->actions[$hook][$priority][] = $callback;
        // Сортируем массив приоритетов после добавления нового действия
        ksort($this->actions[$hook]);
    }

    public function doAction($hook, $args = [])
    {
        if (!isset($this->actions[$hook])) {
            return;
        }

        foreach ($this->actions[$hook] as $priority => $callbacks) {
            foreach ($callbacks as $callback) {
                call_user_func_array($callback, $args);
            }
        }
    }
}