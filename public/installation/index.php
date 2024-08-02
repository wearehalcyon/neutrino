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

    $name = $_GET['login'];
    $email = $_GET['email'];
    $password = password_hash($_GET['password'], PASSWORD_DEFAULT);

    $update_query = "UPDATE nt_users SET name = :name, email = :email, password = :password WHERE id = 1";
    $stmt = $pdo->prepare($update_query);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    $stmt->execute();

    $update_query_settings = "UPDATE nt_settings SET option_value = :email WHERE option_name = 'site_email'";
    $stmt_settings = $pdo->prepare($update_query_settings);
    $stmt_settings->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt_settings->execute();

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
        .button button{
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
        form{
            margin-top: 20px;
        }
        .form-control{
            position: relative;
            display: block;
            margin-top: 10px;
            text-align: center;
        }
        .form-control input{
            width: 300px;
            height: auto;
            max-width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        .logo{
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img{
            width: auto;
            height: 40px;
        }
    </style>
</head>
<body>
    <main class="main">
        <div class="installator-window">
            <div class="logo">
                <img src="../assets/images/svg/nt-logo-dash-dark.svg" alt="Neutrino Logo">
            </div>
            <h1>Installation</h1>
            <p>Welcome to Neutrino installer!</p>
<!--            <p>Click "Run Installer" for automatic installation database.</p>-->
            <h4>Set Administrator credentials</h4>
            <form action="/installation/index.php" method="get">
                <input type="hidden" name="run" value="install">
                <div class="form-control">
                    <input type="text" name="login" placeholder="Name" value="<?php echo isset($_GET['login']) ? $_GET['login'] : ''; ?>" required>
                </div>
                <div class="form-control">
                    <input type="email" name="email" placeholder="Email" value="<?php echo isset($_GET['email']) ? $_GET['email'] : ''; ?>" required>
                </div>
                <div class="form-control">
                    <input type="password" name="password" placeholder="Password" value="<?php echo isset($_GET['password']) ? $_GET['password'] : ''; ?>" required>
                </div>
                <div class="button">
                    <button type="submit" id="install-button">Run Installer</button>
                </div>
            </form>
            <div class="installer-ver">Installer version: 1.0.2</div>
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
