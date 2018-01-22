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
    <li {{ (Route::currentRouteName() == 'dashboard.transactions' ? 'class=active' : '') }}>
        <a href="{{ route('dashboard.transactions') }}">
            <i class="material-icons">directions_run</i>
            <p>Transacties</p>
        </a>
    </li>
    <li {{ (Route::currentRouteName() == 'dashboard.card' ? 'class=active' : '') }}>
        <a href="{{ route('dashboard.card') }}">
            <i class="material-icons">credit_card</i>
            <p>Mijn Pas</p>
        </a>
    </li>
    <li {{ (Route::currentRouteName() == 'dashboard.personalCoach' ? 'class=active' : '') }}>
        <a href="{{ route('dashboard.personalCoach') }}">
            <i class="material-icons">credit_card</i>
            <p>Personal coach</p>
        </a>
    </li>
    <li {{ (Route::currentRouteName() == 'dashboard.locations' ? 'class=active' : '') }}>
        <a href="{{ route('dashboard.locations') }}">
            <i class="material-icons">add_location</i>
            <p>Locaties</p>
        </a>
    </li>
</ul>

