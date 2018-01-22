
@extends('dashboard.blank')

@section('page_title', 'Transacties')

@section('content')
    <div class="card">
        <div class="card-header" data-background-color="orange">
            <h4 class="title">Transacties</h4>
            <p class="category">Here is a subtitle for this table</p>
        </div>
        <div class="card-content table-responsive">
            <table class="table">
                <thead class="text-primary">
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
@endsection