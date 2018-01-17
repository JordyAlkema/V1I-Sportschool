@extends('dashboard.blank')

@section('page_title', 'Mijn pas')

@section('content')
    <h2>Mijn pas</h2>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="green">
                    <i class="material-icons">credit_card</i>
                </div>
                <div class="card-content">
                    <p class="category">Balance</p>
                    <h3 class="title">&euro;5,02</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">date_range</i> Laatste transactie 17 Januari 12:23
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
