<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            font-family: sans-serif;
        }
    </style>
</head>
<body>
    <div style="width: 100%; background-color: #eee; padding: 20px 40px; color: #ddd">
        <img src="{{ asset('report-assets/logos/49_stella-logo.png') }}" alt="">
    </div>
    @yield('content')
</body>
</html>