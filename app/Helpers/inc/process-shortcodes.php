<?php
if (!function_exists('processShortcodes')) {
    function processShortcodes($content) {
        $pattern = '/\[(.*?)\]/';
        
        $callback = function($matches) {
            $shortcode = $matches[1];
    
            $parts = preg_split('/\s+(?=\w+=")/', $shortcode, 2);
            $shortcodeName = $parts[0];
            $attributesString = isset($parts[1]) ? $parts[1] : '';
    
            preg_match_all('/(\w+)="([^"]*)"/', $attributesString, $matches, PREG_SET_ORDER);
            $params = [];
            foreach ($matches as $match) {
                $params[$match[1]] = $match[2];
            }
    
    
            $shortcodeName = str_replace(['-', '_'], ' ', $shortcodeName);
            $shortcodeName = ucwords($shortcodeName);
            $shortcodeName = 'get' . str_replace([' '],  '', $shortcodeName);
    
            if (function_exists($shortcodeName)) {
                return call_user_func($shortcodeName, $params);
            } else {
                return '';
            }
        };
        
        return preg_replace_callback($pattern, $callback, $content);
    }
}