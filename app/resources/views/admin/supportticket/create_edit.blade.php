@extends('admin.layouts.modal')
{{-- Content --}}
@section('content')
        <!-- Tabs -->
<ul class="nav nav-tabs">
    <li class="active"><a href="#tab-general" data-toggle="tab"> {{
            trans("admin/modal.general") }}</a></li>
    <li><a href="#tab-updates" data-toggle="tab"> {{
            trans("admin/modal.updates") }}</a></li>
</ul>
<!-- ./ tabs -->
@if (isset($supportticket))
{!! Form::model($supportticket, array('url' => url('admin/supportticket') . '/' . $supportticket->id, 'method' => 'put', 'class' => 'bf', 'files'=> true)) !!}
@else
{!! Form::open(array('url' => url('admin/supportticket'), 'method' => 'post', 'class' => 'bf', 'files'=> true)) !!}
@endif
        <!-- Tabs Content -->
<div class="tab-content">
    <!-- General tab -->
    <div class="tab-pane active" id="tab-general">
        <div class="form-group  {{ $errors->has('subject') ? 'has-error' : '' }}">
            {!! Form::label('subject', trans("admin/tickets.subject"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('subject', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('subject', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('comment') ? 'has-error' : '' }}">
            {!! Form::label('comment', trans("admin/tickets.comment"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::textarea('comment', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('comment', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('priority') ? 'has-error' : '' }}">

            {!! Form::label('priority', trans("admin/tickets.priority"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::select('priority', $priorities, null, array('class' => 'form-control', 'id' => 'status')) !!}
                <span class="help-block">{{ $errors->first('priority', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('status') ? 'has-error' : '' }}">

            {!! Form::label('status', trans("admin/tickets.status"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::select('status', $statuses, null, array('class' => 'form-control', 'id' => 'status')) !!}
                <span class="help-block">{{ $errors->first('status', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('category_id') ? 'has-error' : '' }}">

            {!! Form::label('category_id', trans("admin/tickets.category_id"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::select('category_id', $categories, null, array('class' => 'form-control', 'id' => 'category_id')) !!}
                <span class="help-block">{{ $errors->first('category_id', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('assigned_to_id') ? 'has-error' : '' }}">

            {!! Form::label('assigned_to_id', trans("admin/tickets.assigned_to_id"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::select('assigned_to_id', $admins, null, array('class' => 'form-control', 'id' => 'assigned_to_id')) !!}
                <span class="help-block">{{ $errors->first('assigned_to_id', ':message') }}</span>
            </div>
        </div>
        <div class="form-group">
        <input name="_token" type="hidden" value="{{csrf_token()}}"/>
        <button type="submit" class="btn btn-sm btn-success">
            <span class="glyphicon glyphicon-ok-circle"></span>
            @if	(isset($supportticket))
                {{ trans("admin/modal.edit") }}
            @else
                {{trans("admin/modal.create") }}
            @endif
        </button>
        </div>
    </div>
    <!-- updates tab -->
    <div class="tab-pane" id="tab-updates">
        <h3>Ticket Updates</h3>
        @if (count($updates) > 0)
            <ul class="clearfix" id="ticketUpdates">
                @foreach ($updates as $update)
                    @if ( $update->direction == 'ENDUSER' )
                        <li class="clearfix">
                            <div class="bubble left">
                                {!! $update->comment !!}
                            </div>
                        </li>
                    @elseif ( $update->direction == 'STAFF' )
                        <li class="clearfix">
                            <div class="bubble right">
                                {!! $update->comment !!}
                            </div>
                        </li>
                    @endif

                @endforeach
            </ul>
        @else
            <div class="nocontent">
                No updates available.
            </div>
        @endif
        <h3>Add Update</h3>
        <form method="POST" action="" name="update_frm">
            <textarea class="form-control" id="updateComment"></textarea>
            <button type="button" id="updateBtn" class="btn btn-info">Submit</button>
    </form>
    </div>

    {!! Form::close() !!}
</div>
@endsection
@section('scripts')
<script>
    var ticketId = "{{$supportticket->id}}";
    $("#updateBtn").click(function(event) {
        console.log('submitting update');
        var comment = $('textarea#updateComment').val();
        var token = $("input[name='_token']").val();
        var data = {
            comment,
            "_token": token
        };
        var url = "/admin/supportticket/" + ticketId +"/addUpdate";
        $.post(url, data, function() {
            console.log('support ticket updated.');
            alert('support ticket updated.');
            location.reload();
        });

    })
</script>
@endsection
