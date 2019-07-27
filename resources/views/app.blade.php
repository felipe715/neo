<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/app.css">
    <title>Neoway Test</title>
</head>
<body>
    <div id="app">
       <router-view></router-view>
    </div>
</body>
<script src="js/app.js"></script>
</html>
