{{ $menu = 'medewerker' }}
@extends('dashboard.blank')

@section('page_title', 'Account van ' . $gebruiker->name)

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="green">
                <h4 class="title">Account aanpassen</h4>
                <p class="category">Update uw gegevens</p>
            </div>
            <div class="card-content">
                <form method="post" action="{{route('medewerker.action.saveUser', ['id' => $gebruiker['id']])}}">
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
                    <button type="submit" class="btn btn-success pull-right">Opslaan</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <a href="{{ route('dashboard.activity') }}">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Activiteiten</h4>
                        <p class="category">Uw laatste 3 activiteiten</p>
                    </div>
                </a>
                <div class="card-content table-responsive">
                    <table class="table table-hover">
                        <thead class="text-warning">
                        <th>Machine</th>
                        <th>Begintijd</th>
                        <th>Tijd op machine</th>
                        <th>Kcal</th>
                        </thead>
                        <tbody>
                        @foreach($gebruiker->activiteiten as $activiteit)
                            <tr>
                                <td>{{$activiteit->automaat->automaattype->naam}}</td>
                                <td>{{$activiteit->begin_datum}}</td>
                                <td>{{$activiteit->tijd}}</td>
                                <td>{{$activiteit->kcal}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <a href="{{ route('dashboard.transactions') }}">
                    <div class="card-header" data-background-color="orange">
                        <h4 class="title">Transacties</h4>
                        <p class="category">Uw afgelopen 3 transacties</p>
                    </div>
                </a>
                <div class="card-content table-responsive">
                    <table class="table table-hover">
                        <thead class="text-warning">
                        <th>Type transactie</th>
                        <th>Bedrag</th>
                        <th>datum</th>
                        </thead>
                        <tbody>
                        @foreach($gebruiker->transacties as $transactie)
                            <tr>
                                <td>{{$transactie->transactietype->naam}}</td>

                                @if($transactie->bedrag > 0)
                                    <td class="text-success">{{number_format($transactie->bedrag, 2)}}</td>
                                @else
                                    <td class="text-danger">{{number_format($transactie->bedrag, 2)}}</td>
                                @endif

                                <td>{{$transactie->datum->toDateString()}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
@endsection