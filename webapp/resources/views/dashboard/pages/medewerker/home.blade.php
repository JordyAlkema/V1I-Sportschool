{{ $menu = 'medewerker' }}
@extends('dashboard.blank')

@section('page_title', 'Dashboard')

@section('content')
    {{--<h2>Welkom, </h2>--}}
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="blue">
                    <i class="material-icons">credit_card</i>
                </div>
                <div class="card-content">
                    <p class="category">Totaal aantal leden</p>
                    <h3 class="title">{{\App\Models\Gebruiker::get()->count()}}</h3>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="orange">
                    <i class="material-icons">credit_card</i>
                </div>
                <div class="card-content">
                    <p class="category">Totaal aantal transacties</p>
                    <h3 class="title">{{\App\Models\Transactie::get()->count()}}</h3>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="green">
                    <i class="material-icons">credit_card</i>
                </div>
                <div class="card-content">
                    <p class="category">Totaal aantal activiteiten</p>
                    <h3 class="title">{{\App\Models\Activiteiten::get()->count()}}</h3>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="red">
                    <i class="material-icons">credit_card</i>
                </div>
                <div class="card-content">
                    <p class="category">Aantal locaties</p>
                    <h3 class="title">{{\App\Models\Locatie::get()->count()}}</h3>
                </div>
            </div>
        </div>
    </div>
@endsection
