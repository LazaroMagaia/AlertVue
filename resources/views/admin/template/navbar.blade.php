
<div class="container">
    <div class="navbar-content">
        <ul>
            <li><a href="/" class="{{ Request::path() === '/' ? 'active' : '' }}">Home</a></li>
            <li><a href="/login" class="{{ Request::path() === '/admin/login' ? 'active' : '' }}">entrar</a></li>
            <li><a href="/admin" class="{{ Request::path() === '/admin' ? 'active' : '' }}">Home Admin</a></li>
            <li><a href="/admin/alerta" class="{{ Request::path() === '/admin/alerta' ? 'active' : '' }}">Alerta</a></li>
        </ul>
    </div><!--nav-content-->

</div><!--container-->