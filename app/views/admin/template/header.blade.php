
<header>
    <h1>Bienvenido {{ Auth::user()->usuario; }}</h1>
</header>
<nav>
    <ul>
        <li style="display:inline;"><a href="{{URL::to('admin/home');}}">Home</a></li>
        <li style="display:inline;"><a href="{{URL::to('admin/orders/index');}}">Orders</a></li>
        <li style="display:inline;"><a href="{{URL::to('admin/messages/index');}}">Msges/Notif</a></li>
        <li style="display:inline;"><a href="{{URL::to('admin/languages/index');}}">Languag/Rates</a></li>
        <li style="display:inline;"><a href="{{URL::to('admin/linguists/index');}}">Linguists</a></li>
        <li style="display:inline;"><a href="{{URL::to('admin/reports/index');}}">Reports</a></li>
        <li style="display:inline;"><a href="{{URL::to('admin/settings/account');}}">Settings</a></li>
        <li style="display:inline;"><a href="{{URL::to('admin/help/index');}}">Help</a></li>
        <li style="display:inline;"><a href="{{URL::to('admin/home');}}">Others(Wordpress/Admin)</a></li>
        <li style="display:inline;"><a href="{{URL::to('/');}}/logout">Cerrar sesión</a></li>
    </ul>
</nav>

