@extends('dashboard.blank')

@section('page_title', 'Personal coach')

@section('content')
    <div class="card">
    <div class="card-header" data-background-color="purple">
        <h4 class="title">Neem contact op met een personal coach</h4>
        <p class="category">Complete your profile</p>
    </div>
    <div class="card-content">
        <form>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Personal coach:</label>
                        <select>

                        </select>
                        <div class="form-group label-floating is-empty">
                            <label class="control-label"> Uw bericht</label>
                            <textarea class="form-control" rows="5"></textarea>
                            <span class="material-input"></span></div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary pull-right">Update Profile</button>
            <div class="clearfix"></div>
        </form>
    </div>
</div>
@endsection