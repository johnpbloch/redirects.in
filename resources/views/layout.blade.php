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
            @include('partials.form')
        @show
    </div>
    <footer>
        <span id="copyright">Copyright &copy; {{ date('Y') }}</span>
        &bull;
        <span id="created_by">Created by <a href="https://johnpbloch.com">John P Bloch</a></span>
    </footer>
</div>
</body>
</html>
