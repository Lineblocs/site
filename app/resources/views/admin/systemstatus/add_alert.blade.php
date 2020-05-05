@extends('admin.layouts.modal')
{{-- Content --}}
@section('content')

<form method="POST" name="add_alert_frm" close="no" next="/admin/systemstatus/{{$systemstatus->id}}/edit">
    <div class="row clearfix">
        <label>Title</label>
        <input class="form-control" name="title" id="title"/>
    </div>
    <div class="row clearfix">
        <label>Body</label>
        <textarea class="form-control" name="body" id="title"></textarea>
    </div>
    <div class="row clearfix">
        <label>Status</label>
        <select name="status" id="status" class="form-control">
            <option value="UP">Up</option>
            <option value="DOWN">Down</option>
            <option value="IN-MAINTENANCE">In Maintenance</option>
        </select>
    </div>
    <div class="row clearfix">
        <br/>
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <button type="submit" class="btn btn-success">Submit</button>
    </div>
</form>
    {!! Form::close() !!}
    @endsection @section('scripts')
        <script type="text/javascript">
            $(function () {
                $("form[name='add_alert_frm']").submit(function(event) {
                });
            });
        </script>
</div>
@endsection
