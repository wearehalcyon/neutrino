<?php
require_once 'checker.php';
if (!$connection) {
    header("Location: " . '/installation/error-connection.php');
    exit(1);
}

if (isset($_GET['run']) && $_GET['run'] == 'install') {
    $sql_file = 'db/database.sql';
    $sql = file_get_contents($sql_file);
    $sql_commands = explode(';', $sql);
    foreach ($sql_commands as $sql_command) {
        $sql_command = trim($sql_command);

        if (!empty($sql_command)) {
            $pdo->exec($sql_command);
        }
    }

    header('Location:' . '/installation/finished.php');
    exit(1);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome | Install Neutrino</title>
    <style>
        *{
            box-sizing: border-box;
            outline: none;
            padding: 0;
            margin: 0;
        }
        body{
            background: radial-gradient(ellipse at center,  #7f7f7f 0%,#2b2b2b 100%);
            font-family: system-ui, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
        }
        .main{
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100vh;
            position: relative;
        }
        .installator-window{
            width: 760px;
            min-height: 300px;
            max-width: 100%;
            margin: 20px;
            background-color: #fff;
            box-shadow: 0 5px 10px rgba(0,0,0,.3);
            padding: 30px;
        }
        h1{
            font-weight: 500;
            text-align: center;
            margin-bottom: 10px;
        }
        p{
            text-align: center;
            margin-bottom: 10px;
        }
        h4{
            font-weight: 500;
            text-align: center;
            margin-bottom: 10px;
        }
        .tab{
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
        }
        code{
            padding: 10px;
            border: 1px solid #ccc;
            width: 400px;
            height: 150px;
            overflow-y: auto;
            font-size: 15px;
        }
        .button{
            text-align: center;
            margin-top: 20px;
        }
        .button a{
            display: inline-block;
            position: relative;
            color: #fff;
            border: none;
            padding: 8px 20px;
            background-color: #246fff;
            font-weight: 500;
            font-size: 15px;
            border-radius: 4px;
            letter-spacing: 1px;
            cursor: pointer;
            text-decoration: none;
        }
        .button a:hover{
            background-color: #195bd9;
        }
        .installer-ver{
            text-align: center;
            font-size: 13px;
            color: #b3b3b3;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <main class="main">
        <div class="installator-window">
            <h1>Install Neutrino</h1>
            <p>Welcome to Neutrino installer!</p>
            <p>Click "Run Installer" for automatic installation database.</p>
            <div class="button">
                <a id="install-button" href="/installation/index.php?run=install">Run Installer</a>
            </div>
            <div class="installer-ver">Installer version: 1.0.1</div>
        </div>
    </main>
    <script>
        const installButton = document.getElementById('install-button');

        installButton.addEventListener('click', function() {
            const spinnerImg = document.createElement('img');
            spinnerImg.src = 'spinner.svg';
            spinnerImg.alt = 'Loading...';
            spinnerImg.width = '16';
            spinnerImg.height = '16';

            installButton.innerHTML = '';
            installButton.appendChild(spinnerImg);
        });
    </script>
</body>
</html>
