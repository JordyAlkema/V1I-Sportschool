@extends('dashboard.blank')

@section('page_title', 'Personal coach')

@section('content')
    <div class="card">
    <div class="card-header" data-background-color="red">
        <h4 class="title">Neem contact op met een personal coach</h4>
    </div>
    <div class="card-content">
        <form method="post" action="{{ route('action.sendMessage') }}">
            {{csrf_field()}}
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Personal coach:</label>
                        <select name="medewerker">
                            @foreach(\App\Models\Medewerker::all() as $medewerker)
                                @if($medewerker->tussenvoegsel == null)
                                    <option value="{{$medewerker->id}}">{{$medewerker->naam}} {{$medewerker->achternaam}} - {{$medewerker->locatie->naam}}</option>
                                @else
                                    <option value="{{$medewerker->id}}">{{$medewerker->naam}} {{$medewerker->tussenvoegsel}} {{$medewerker->achternaam}} - {{$medewerker->locatie->naam}}</option>
                                @endif
                            @endforeach
                        </select>
                        <div class="form-group label-floating is-empty">
                            <label class="control-label"> Uw bericht</label>
                            <textarea name='message' class="form-control" rows="5"></textarea>
                            <span class="material-input"></span></div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn pull-right">Verstuur bericht</button>
            <div class="clearfix"></div>
        </form>
    </div>
</div>
@endsection