<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Error - 404</title>
    {{ getHead() }}
    <style>
        body{
            background: #000;
            color: #fff;
            font-family: sans-serif;
            overflow: hidden;
        }
        .error-page{
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            width: 100vw;
            height: 100vh;
        }
        .error-page img{
            width: 500px;
            height: auto;
            max-width: 100%;
        }
        .cta{
            text-align: center;
            margin-top: 50px;
        }
        .cta a{
            display: inline-block;
            text-decoration: none;
            background-color: #FFA800;
            color: #000;
            border-radius: 4px;
            padding: 15px 30px;
            font-weight: 600;
            text-transform: uppercase;
        }
        .cta a:hover{
            background-color: #fff;
        }
    </style>
</head>
<body>
    <main class="error-page">
        <div>
            <img src="{{ getThemeAssetsUri('/assets/images/error-404.webp') }}" alt="Error 404 Image">
            <div class="cta">
                <a href="{{ url('/') }}" title="Go to homepage">Go to Homepage</a>
            </div>
        </div>
    </main>
</body>
</html>