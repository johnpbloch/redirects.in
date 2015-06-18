<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')Redirects.in</title>
    <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
</head>
<body>
<div id="container">
    <h1>Redirects In&hellip;</h1>
    <div id="content">
        @section('content')
            @include('partials.form');
        @show
    </div>
</div>
</body>
</html>
