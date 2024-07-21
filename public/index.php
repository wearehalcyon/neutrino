<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Check If The Application Is Under Maintenance
|--------------------------------------------------------------------------
|
| If the application is in maintenance / demo mode via the "down" command
| we will load this file so that any pre-rendered content can be shown
| instead of starting the framework, which could cause an exception.
|
*/

if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| this application. We just need to utilize it! We'll simply require it
| into the script here so we don't need to manually load our classes.
|
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request using
| the application's HTTP kernel. Then, we will send the response back
| to this client's browser, allowing them to enjoy our application.
|
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();
try {
    $dsn = $_ENV['DB_CONNECTION'] . ":host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_DATABASE'];
    $pdo = new PDO($dsn, $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);

    switch ($_ENV['DB_CONNECTION']) {
        case 'mysql':
            $stmt = $pdo->query("SHOW TABLES");
            break;
        case 'pgsql':
            $stmt = $pdo->query("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public'");
            break;
        case 'sqlite':
            $stmt = $pdo->query("SELECT name FROM sqlite_master WHERE type='table'");
            break;
        default:
            throw new Exception("Unsupported database type: " . $_ENV['DB_CONNECTION']);
    }

    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

    if (empty($tables)) {
        header("Location: " . '/installation/index.php');
        exit(1);
    }
} catch (\PDOException $e) {
    header("Location: " . '/installation/error-connection.php');
    exit(1);
} catch (\Exception $e) {
    echo "Ошибка: " . $e->getMessage();
    exit(1);
}

$kernel = $app->make(Kernel::class);

$response = $kernel->handle(
    $request = Request::capture()
)->send();

$kernel->terminate($request, $response);
