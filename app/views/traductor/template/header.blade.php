<header>
    <h1>Bienvenido {{ Auth::user()->usuario; }}</h1>
</header>
<nav>
    <ul>
        <li style="display:inline;"><a href="{{URL::to('traductor/home');}}">Home</a></li>
        <li style="display:inline;"><a href="{{URL::to('/');}}/logout">Cerrar sesión</a></li>
    </ul>
</nav>