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

$dbhost = $_ENV['DB_HOST'] ?? null;
$dbuser = $_ENV['DB_USERNAME'] ?? null;
$dbpass = $_ENV['DB_PASSWORD'] ?? null;
$dbtype = $_ENV['DB_CONNECTION'] ?? null;
$dbname = $_ENV['DB_DATABASE'] ?? null;
$dbport = $_ENV['DB_PORT'] ?? null;
$dbsock = $_ENV['DB_SOCKET'] ?? null;

try {
    $dsn = $dbtype . ":host=" . $dbhost . ";dbname=" . $dbname;
    $pdo = new PDO($dsn, $dbuser, $dbpass);

    switch ($dbtype) {
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
            throw new Exception("Unsupported database type: " . $dbtype);
    }

    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

    if (empty($tables)) {
        $connection = true;
    }
} catch (\PDOException $e) {
    $connection = false;
    $tables = false;
}
