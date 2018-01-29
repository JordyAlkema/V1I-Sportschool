@extends('dashboard.blank')

@section('page_title', 'Transactie')

@section('content')
<div class="card">
    <div class="card-header" data-background-color="purple">
        <h4 class="title">Activiteit</h4>
        <p class="category">Een compleet activiteit</p>
    </div>
    <div class="card-content">
        <form>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group label-floating is-empty">
                        <label class="control-label">Company (disabled)</label>
                        <input type="text" class="form-control" disabled="">
                        <span class="material-input"></span></div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary pull-right">Update Profile</button>
            <div class="clearfix"></div>
        </form>
    </div>
</div>
@endsection