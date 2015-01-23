<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laravel PHP Framework</title>
</head>
<body>
    <div class="container ui-state-default">
        <h1>Bienvenido {{ Auth::user()->usuario; }}</h1>
        <a href="{{URL::to('/');}}/logout">Cerrar sesión.</a>
    </div>
</body>
</html>