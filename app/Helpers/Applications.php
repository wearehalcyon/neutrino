<?php
use App\Models\Application;

// Load applications
$appsRoot = __DIR__ . '/../../app/Applications/';
$appsDir = glob($appsRoot . '*', GLOB_ONLYDIR);

$apps = [];
foreach ($appsDir as $item) {
    $appName = basename($item);

    $appDB = Application::where('name', $appName)->first();

    if (!$appDB) {
        Application::create([
            'name' => $appName,
            'slug' => $appName . '/' . $appName,
            'status' => 0
        ]);
    }

    include $appsRoot . $appName . '/' . $appName . '.php';

    if (file_exists($appsRoot . $appName . '/' . $appName . '.php')) {
        $filePHP = $appsRoot . $appName . '/' . $appName . '.php';
    } else {
        $filePHP = null;
    }
    if (file_exists($appsRoot . $appName . '/' . 'info.json')) {
        $fileJSON = json_decode(file_get_contents($appsRoot . $appName . '/' . 'info.json'));
    } else {
        $fileJSON = null;
    }
    if (file_exists($appsRoot . $appName . '/' . 'icon.svg')) {
        $fileSVG = file_get_contents($appsRoot . $appName . '/' . 'icon.svg');
    } else {
        $fileSVG = null;
    }

    $apps[] = [
        'php' => $filePHP,
        'json' => $fileJSON,
        'svg' => $fileSVG,
    ];
}

if (!function_exists('getApps')) {
    function getApps(){
        $appsRoot = __DIR__ . '/../../app/Applications/';
        $appsDir = glob($appsRoot . '*', GLOB_ONLYDIR);

        $apps = [];
        foreach ($appsDir as $item) {
            $appName = basename($item);
            require $appsRoot . $appName . '/' . $appName . '.php';

            if (file_exists($appsRoot . $appName . '/' . $appName . '.php')) {
                $filePHP = $appsRoot . $appName . '/' . $appName . '.php';
            } else {
                $filePHP = null;
            }
            if (file_exists($appsRoot . $appName . '/' . 'info.json')) {
                $fileJSON = json_decode(file_get_contents($appsRoot . $appName . '/' . 'info.json'));
            } else {
                $fileJSON = null;
            }
            if (file_exists($appsRoot . $appName . '/' . 'icon.svg')) {
                $fileSVG = file_get_contents($appsRoot . $appName . '/' . 'icon.svg');
            } else {
                $fileSVG = null;
            }

            $apps[] = [
                'php' => $filePHP,
                'json' => $fileJSON,
                'svg' => $fileSVG,
            ];
        }

        return $apps;
    }
}