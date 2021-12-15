@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title') {!! trans("admin/callrates.call_rates") !!} :: @parent
@endsection

{{-- Content --}}
@section('main')
    <div class="page-header">
        <h3>
            {!! trans("admin/settings.settings") !!}
        </h3>
    </div>
    <div class="col-md-12">
        <form method="POST" action="">
            <div class="row form-group">
                <label for="aws_access_key_id">Company logo</label>
                <div class="controls">
                    <input id="aws_access_key_id" type="text" class="form-control" name="aws_access_key_id" value="{{$creds->aws_access_key_id}}"/>
                </div>
            </div>
            <div class="row form-group">
                <label for="smtp_password">Color theme</label>
                <div class="controls">
                    <input id="smtp_password" type="text" class="form-control" name="smtp_password" value="{{$creds->smtp_password}}"/>
                </div>
            </div>
            <div class="row form-group">
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </form>
</div>
@endsection

{{-- Scripts --}}
@section('scripts')
@endsection
