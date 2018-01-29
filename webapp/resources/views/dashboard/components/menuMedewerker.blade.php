<ul class="nav">
    <li {{ (Route::currentRouteName() == 'medewerker.dashboard' ? 'class=active' : '') }}>
        <a href="{{ route('medewerker.dashboard') }}">
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
    <li {{ (Route::currentRouteName() == 'medewerker.gebruikers' ? 'class=active' : '') }}>
        <a href="{{ route('medewerker.gebruikers') }}">
            <i class="material-icons">add_location</i>
            <p>Gebruiker</p>
        </a>
    </li>
</ul>

