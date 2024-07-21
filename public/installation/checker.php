<?php
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}
require __DIR__.'/../../vendor/autoload.php';
$app = require_once __DIR__.'/../../bootstrap/app.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../..');
$dotenv->load();

$dbhost = $_ENV['DB_HOST'];
$dbuser = $_ENV['DB_USERNAME'];
$dbpass = $_ENV['DB_PASSWORD'];
$dbtype = $_ENV['DB_CONNECTION'];
$dbname = $_ENV['DB_DATABASE'];

$dsn = $dbtype . ":host=" . $dbhost . ";dbname=" . $dbname;
$pdo = new PDO($dsn, $dbuser, $dbpass);
