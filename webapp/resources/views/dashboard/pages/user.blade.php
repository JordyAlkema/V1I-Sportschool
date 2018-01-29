@extends('dashboard.blank')

@section('page_title', 'Mijn Account')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header" data-background-color="purple">
            <h4 class="title">Account aanpassen</h4>
            <p class="category">Update uw gegevens</p>
        </div>
        <div class="card-content">
            <form method="post" action="{{route('action.saveUser')}}">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group label-floating is-empty">
                            <label class="label">Voornaam</label>
                            <input type="text" class="form-control" name="voornaam" value="{{$gebruiker['voornaam']}}">
                            <span class="material-input"></span></div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group label-floating is-empty">
                            <label class="label">Tussernvoegsel</label>
                            <input type="text" class="form-control" name='tussenvoegsel' value="{{$gebruiker['tussenvoegsel']}}">
                            <span class="material-input"></span></div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group label-floating is-empty">
                            <label class="label">Achternaam</label>
                            <input type="text" class="form-control" name='achternaam' value="{{$gebruiker['achternaam']}}">
                            <span class="material-input"></span></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group label-floating is-empty">
                            <label class="label">Email adres</label>
                            <input type="email" class="form-control" name='email' value="{{$gebruiker['email']}}">
                            <span class="material-input"></span></div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group label-floating is-empty">
                            <label class="label">geboortedatum</label>
                            <input type="date" class="form-control" name='geboortedatum' value="{{$gebruiker['geboortedatum']->toDateString()}}">
                            <span class="material-input"></span></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group label-floating is-empty">
                            <label class="label">Pasnummer</label>
                            <input type="text" class="form-control" value="{{$gebruiker['pasnummer']}}" disabled>
                            <span class="material-input"></span></div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary pull-right">Opslaan</button>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</div>
@endsection