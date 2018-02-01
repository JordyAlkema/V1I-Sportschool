@extends('dashboard.blank')

@section('page_title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="green">
                    <i class="material-icons">credit_card</i>
                </div>
                <div class="card-content">
                    <p class="category">Uw tegoed</p>
                    <h3 class="title">€{{ number_format($user->balance, 2) }}</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">date_range</i> Laatste transactie {{$latestTransaction}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="blue">
                    <i class="material-icons">credit_card</i>
                </div>
                <div class="card-content">
                    <p class="category">Abonnement</p>
                    <h3 class="title">
                    @if($user->abonnement)
                        {{$user->abonnement->abbonement->naam}}
                    @else
                        Flexibel
                    @endif
                    </h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">date_range</i>
                        @if($user->AbonnementTill)
                             Geldig tot {{$user->AbonnementTill}}
                        @else
                            Geldig voor altijd
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="red">
                    <i class="material-icons">credit_card</i>
                </div>
                <div class="card-content">
                    <p class="category">verbrand</p>
                    <h4 class="title">
                        {{$user->KcalMonth}} Kcal
                    </h4>

                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">date_range</i> Afgelopen maand
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-plain">
                <div class="card-header text-center" data-background-color="blue">
                    <h4 class="title">{{$motivation}}</h4>
                </div>
            </div>
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
                        </thead>
                        <tbody>
                        @foreach($activiteiten as $activiteit)
                            <tr>
                                <td>{{$activiteit->automaat->automaattype->naam}}</td>
                                <td>{{$activiteit->begin_datum}}</td>
                                <td>{{$activiteit->tijd}} Minuten</td>
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
                        @foreach($transacties as $transactie)
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
