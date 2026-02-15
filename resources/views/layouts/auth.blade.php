<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">


    @vite(['resources/css/app.css'])
</head>


<body class="auth-body">
    @yield('content')
</body>
</html>
