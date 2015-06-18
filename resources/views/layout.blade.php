<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')Redirects.in</title>
    <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
</head>
<body>
<div id="container">
    <div class="content">
        <div class="title">Laravel 5</div>
        <div class="quote">{{ Inspiring::quote() }}</div>
    </div>
</div>
</body>
</html>
