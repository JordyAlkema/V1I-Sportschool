@if (session('error'))
    <div class="alert alert-error">
        {{ session('error') }}
    </div>
@endif

<form method="post" action="/login">
    {{ csrf_field() }}

    <input type="email" name="email" placeholder="Email adres"/>
    <input type="password" name="password" placeholder="Wachtwoord"/>

    <input type="submit"/>

</form>

@if (config('app.debug'))
    @include('sudosu::user-selector')
@endif