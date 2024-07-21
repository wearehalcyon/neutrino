<?php require_once 'checker.php'; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Success | Install Neutrino</title>
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
            <?php if ($tables) : ?>
                <h1>Finished!</h1>
                <p>Neutrino was installed successfully.</p>
                <h4>Administrator data:</h4>
                <div class="tab">
                    <code>
                        <strong>LOGIN:</strong> admin@admin.com<br>
                        <strong>PASSWORD:</strong> Administrator<br>
                    </code>
                </div>
                <p style="margin-top: 20px; font-size: 14px;">Remove <strong>installation</strong> folder from <strong>public</strong> folder for your seccurity<br>
                    and change this credentials in administrator settings page.</p>
                <div class="button">
                    <a id="install-button" href="/">Open Site</a>
                    <a id="install-button" href="/nt-admin">Open Dashboard</a>
                </div>
            <?php else : ?>
                <h1>Error</h1>
                <p>Neutrino still not installed.</p>
                <div class="button">
                    <a id="install-button" href="/installation/index.php">Install</a>
                </div>
            <?php endif; ?>
            <div class="installer-ver">Installer version: 1.0.1</div>
        </div>
    </main>
</body>
</html>
