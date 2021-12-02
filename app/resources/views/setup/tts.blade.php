@extends('layouts.setup')
@section('title') Home :: @parent @endsection
@section('content')
<div class="main">
    <div class="col-md-12">
    <div class="setup-form">
        <p>Please select a text-to-speech engine.</p>
        <form method="POST">
            <div class="form-group">
                <label>Select provider</label>
                <select class="form-control" name="tts_provider">
                    <option value="aws">Google cloud speech</option>
                </select>
            </div>
            <div class="form-group">
                <label>Google service account JSON</label>
                <textarea class="form-control" placeholder="" name="google_service_account_json" value="{{$google_service_account_json}}">{{$google_service_account_json}}</textarea>
            </div>
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <button type="submit" class="btn btn-secondary">Next</button>
        </form>
    </div>
    </div>
</div>
@endsection