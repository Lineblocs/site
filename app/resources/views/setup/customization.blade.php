@extends('layouts.setup')
@section('title') Home :: @parent @endsection
@section('content')
<div class="main">
    <div class="col-md-12">
    <div class="setup-form">
        <p>UI customizations</p>
        <form method="POST">
            <div class="form-group">
                <label>Company name</label>

                <div class="form-controls">
                    <input id="name" type="text" class="form-control" name="name" value="{{$name}}" required/>
                </div>
            </div>
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <button type="submit" class="btn btn-secondary">Save</button>
        </form>
    </div>
    </div>
</div>
@endsection