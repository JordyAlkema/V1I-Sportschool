
@extends('dashboard.blank')

@section('page_title', 'Activiteiten')

@section('content')
<div class="card">
    <div class="card-header" data-background-color="purple">
        <h4 class="title">Activiteiten</h4>
        <p class="category">Here is a subtitle for this table</p>
    </div>
    <div class="card-content table-responsive">
        <table class="table">
            <thead class="text-primary">
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
@endsection