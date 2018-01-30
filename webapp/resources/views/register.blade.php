@if (session('error'))
    <div class="alert alert-error">
        {{ session('error') }}
    </div>
@endif

<h1>Registreer</h1>
<form method="post" action="/register">
    {{ csrf_field() }}

    <input type="email" name="email" placeholder="Email adres"/>
    <input type="password" name="password" placeholder="Wachtwoord"/>

    <input type="submit"/>

</form>