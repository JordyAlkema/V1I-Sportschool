{{ $menu = 'medewerker' }}
@extends('dashboard.blank')

@section('page_title', 'Dashboard')

@section('content')
    <div class="card">
        <div class="card-header" data-background-color="purple">
            <h4 class="title">Gebruikers</h4>
            <p class="category">Alle gebruikers van Benno's in een overzicht</p>
        </div>
        <div class="card-content table-responsive">
            <table class="table">
                <thead class="text-primary">
                <th>Voornaam</th>
                <th>Tussenvoegsel</th>
                <th>Achternaam</th>
                <th>Saldo</th>
                <th>Abonnement</th>
                <th>Actie</th>
                </thead>
                <tbody>
                @foreach($gebruikers as $gebruiker)
                    <tr>
                        <td>{{$gebruiker->voornaam}}</td>
                        <td>{{$gebruiker->tussenvoegsel}}</td>
                        <td>{{$gebruiker->achternaam}}</td>
                        <td>{{$gebruiker->balance}}</td>
                        <td>
                            @if($gebruiker->abonnement)
                                {{$gebruiker->abonnement->abbonement->naam}}
                            @else
                                Flexibel
                            @endif
                        </td>
                        <td><a href="{{route('medewerker.gebruiker', ['id' => $gebruiker->id])}}">Wijzig</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
