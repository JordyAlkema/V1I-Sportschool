@extends('dashboard.blank')

@section('page_title', 'Overzicht')

@section('content')
    <h2>Overzicht</h2>
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-header" data-background-color="purple">
                    <h4 class="title">Activiteiten</h4>
                    <p class="category">De laatste 3 activiteiten</p>
                </div>
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
                                <td>{{$activiteit->tijd}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-header" data-background-color="orange">
                    <h4 class="title">Transacties</h4>
                    <p class="category">De afgelopen 3 transacties</p>
                </div>
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

                                <td>{{$transactie->datum}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
@endsection
