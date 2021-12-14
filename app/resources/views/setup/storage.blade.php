@extends('layouts.setup')
@section('title') Home :: @parent @endsection
@section('content')
<div class="main">
    <div class="col-md-12">
    <div class="setup-form">
        <p>Please let us know how Lineblocs should storage data.</p>
        <div class="alert alert-primary" role="alert">
            Note: Lineblocs will use your storage provider to save text to speech files, user media files, and recordings.
        </div>
        <form method="POST">
            <div class="form-group">
                <label>Storage Provider</label>
                <select class="form-control" name="storage_provider">
                    <option value="aws">AWS</option>
                </select>
            </div>
            <div class="form-group">
                <label>AWS access key</label>
                <input type="text" class="form-control" placeholder="" name="aws_access_key_id" value="{{$aws_access_key_id}}"/>
            </div>
            <div class="form-group">
                <label>AWS secret access key</label>
                <input type="text" class="form-control" placeholder="" name="aws_secret_access_key" value="{{$aws_secret_access_key}}"/>
            </div>
            <div class="form-group">
                <label>AWS region</label>
                    <select class="form-control" name="aws_region" id="aws_region">
                        @foreach ( $aws_regions as $key => $region )
                            @if ($region==$selected_region)
                                <option value="{{$key}}" selected>{{$region}}</option>
                            @else
                                <option value="{{$key}}">{{$region}}</option>
                            @endif
                        @endforeach
                    </select>
            </div>
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <button type="submit" class="btn btn-secondary">Next</button>
        </form>
    </div>
    </div>
</div>
@endsection