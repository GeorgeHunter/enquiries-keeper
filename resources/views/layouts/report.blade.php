<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="css/app.css">
    <title>Document</title>
    <style>
        body {
            font-family: sans-serif;
        }
    </style>
</head>
<body>
<div id="app">

    <div style="width: 100%; background-color: #eee; padding: 20px 40px; color: #ddd" class="mb-5">
        <img src="{{ asset('report-assets/logos/49_stella-logo.png') }}" alt="">
    </div>
    @yield('content')
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>