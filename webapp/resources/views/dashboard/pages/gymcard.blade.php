@extends('dashboard.blank')

@section('page_title', 'Mijn pas')

@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="green">
                    <i class="material-icons">credit_card</i>
                </div>
                <div class="card-content">
                    <p class="category">Balance</p>
                    <h3 class="title">{{$user->balance}}</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">date_range</i> Laatste transactie 17 Januari 12:23
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h2>Opladen</h2>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="{{ route('action.addBalance', 10) }}">
            <div class="card card-stats">
                <div class="card-header" data-background-color="green">
                    <i class="material-icons">add_shopping_cart</i>
                </div>
                <div class="card-content">
                    <p class="category">Opladen</p>
                    <h3 class="title">10
                        <small>Euro</small>
                    </h3>
                </div>
            </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="{{ route('action.addBalance', 20) }}">
            <div class="card card-stats">
                <div class="card-header" data-background-color="blue">
                    <i class="material-icons">add_shopping_cart</i>
                </div>
                <div class="card-content">
                    <p class="category">Opladen</p>
                    <h3 class="title">20
                        <small>Euro</small>
                    </h3>
                </div>
            </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="{{ route('action.addBalance', 50) }}">
            <div class="card card-stats">
                <div class="card-header" data-background-color="purple">
                    <i class="material-icons">add_shopping_cart</i>
                </div>
                <div class="card-content">
                    <p class="category">Opladen</p>
                    <h3 class="title">50
                        <small>Euro</small>
                    </h3>
                </div>
            </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="{{ route('action.addBalance', 100) }}">
            <div class="card card-stats">
                <div class="card-header" data-background-color="orange">
                    <i class="material-icons">add_shopping_cart</i>
                </div>
                <div class="card-content">
                    <p class="category">Opladen</p>
                    <h3 class="title">100
                        <small>Euro</small>
                    </h3>
                </div>
            </div>
            </a>
        </div>

    </div>
@endsection
