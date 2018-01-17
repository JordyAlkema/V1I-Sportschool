<ul class="nav">
    <li {{ (Route::currentRouteName() == 'dashboard' ? 'class=active' : '') }}>
        <a href="{{ route('dashboard') }}">
            <i class="material-icons">dashboard</i>
            <p>Dashboard</p>
        </a>
    </li>
    <li {{ (Route::currentRouteName() == 'dashboard.account' ? 'class=active' : '') }}>
        <a href="{{ route('dashboard.account') }}">
            <i class="material-icons">person</i>
            <p>Mijn account</p>
        </a>
    </li>
    <li {{ (Route::currentRouteName() == 'dashboard.activity' ? 'class=active' : '') }}>
        <a href="{{ route('dashboard.activity') }}">
            <i class="material-icons">directions_run</i>
            <p>Activiteit</p>
        </a>
    </li>
    <li>
        <a href="{{ route('logout') }}">
            <i class="material-icons text-gray">exit_to_app</i>
            <p>Uitloggen</p>
        </a>
    </li>
</ul>

