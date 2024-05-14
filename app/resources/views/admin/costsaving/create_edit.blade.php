@extends('admin.layouts.modal')
{{-- Content --}}
@section('content')
        <!-- Tabs -->
<ul class="nav nav-tabs">
    <li class="active"><a href="#tab-general" data-toggle="tab"> {{
            trans("admin/modal.general") }}</a></li>
</ul>
<!-- ./ tabs -->
@if (isset($costsaving))
{!! Form::model($costsaving, array('url' => url('admin/costsaving') . '/' . $costsaving->id, 'method' => 'put', 'class' => 'bf', 'files'=> true)) !!}
@else
{!! Form::open(array('url' => url('admin/costsaving'), 'method' => 'post', 'class' => 'bf', 'files'=> true)) !!}
@endif
        <!-- Tabs Content -->
<div class="tab-content">
    <!-- General tab -->
    <div class="tab-pane active" id="tab-general">
        <div class="form-group  {{ $errors->has('competitor_id') ? 'has-error' : '' }}">
            {!! form::label('competitor_id', trans("admin/costsavings.competitor_name"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! form::select('competitor_id', $competitors, null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('competitor_id', ':message') }}</span>
            </div>
        </div>

        <h2>SMS rates</h2>
        <hr/>
        <h4>Local numbers</h4>
        <div class="form-group  {{ $errors->has('local_number_monthly') ? 'has-error' : '' }}">
            {!! Form::label('sms_send_via_local_number', trans("admin/costsavings.send_rate"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::number('sms_send_via_local_number', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('sms_send_via_local_number', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('local_number_monthly') ? 'has-error' : '' }}">
            {!! Form::label('sms_receive_via_local_number', trans("admin/costsavings.receive_rate"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::number('sms_receive_via_local_number', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('sms_receive_via_local_number', ':message') }}</span>
            </div>
        </div>




        <h4>Toll free numbers</h4>
        <div class="form-group  {{ $errors->has('toll_free_number_monthly') ? 'has-error' : '' }}">
            {!! Form::label('sms_send_via_toll_free_number', trans("admin/costsavings.send_rate"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::number('sms_send_via_toll_free_number', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('sms_send_via_toll_free_number', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('toll_free_number_monthly') ? 'has-error' : '' }}">
            {!! Form::label('sms_receive_via_toll_free_number', trans("admin/costsavings.receive_rate"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::number('sms_receive_via_toll_free_number', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('sms_receive_via_toll_free_number', ':message') }}</span>
            </div>
        </div>

        <h4>Short codes</h4>
        <div class="form-group  {{ $errors->has('short_code_monthly') ? 'has-error' : '' }}">
            {!! Form::label('sms_send_via_short_code', trans("admin/costsavings.send_rate"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::number('sms_send_via_short_code', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('sms_send_via_short_code', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('short_code_monthly') ? 'has-error' : '' }}">
            {!! Form::label('sms_receive_via_short_code', trans("admin/costsavings.receive_rate"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::number('sms_receive_via_short_code', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('sms_receive_via_short_code', ':message') }}</span>
            </div>
        </div>

        <h2>VoIP and calling</h2>
        <hr/>
        <div class="form-group  {{ $errors->has('local_number_monthly') ? 'has-error' : '' }}">
            {!! Form::label('sms_send_via_local_number', trans("admin/costsavings.send_rate"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::number('sms_send_via_local_number', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('sms_send_via_local_number', ':message') }}</span>
            </div>
        </div>

        <div class="form-group  {{ $errors->has('pstn_calls') ? 'has-error' : '' }}">
            {!! Form::label('pstn_calls', trans("admin/costsavings.pstn_calls"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::number('pstn_calls', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('pstn_calls', ':message') }}</span>
            </div>
        </div>

        <div class="form-group  {{ $errors->has('receive_calls_on_local_number') ? 'has-error' : '' }}">
            {!! Form::label('receive_calls_on_local_number', trans("admin/costsavings.receive_calls_on_local_number"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::number('receive_calls_on_local_number', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('receive_calls_on_local_number', ':message') }}</span>
            </div>
        </div>

        <div class="form-group  {{ $errors->has('webrtc_calling_rates') ? 'has-error' : '' }}">
            {!! Form::label('webrtc_calling_rates', trans("admin/costsavings.webrtc_calling_rates"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::number('webrtc_calling_rates', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('webrtc_calling_rates', ':message') }}</span>
            </div>
        </div>

        <div class="form-group  {{ $errors->has('call_recordings') ? 'has-error' : '' }}">
            {!! Form::label('call_recordings', trans("admin/costsavings.call_recordings"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::number('call_recordings', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('call_recordings', ':message') }}</span>
            </div>
        </div>

        <div class="form-group  {{ $errors->has('call_recordings_storage') ? 'has-error' : '' }}">
            {!! Form::label('call_recordings_storage', trans("admin/costsavings.call_recordings_storage"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::number('call_recordings_storage', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('call_recordings_storage', ':message') }}</span>
            </div>
        </div>

        <div class="form-group  {{ $errors->has('conference_calls') ? 'has-error' : '' }}">
            {!! Form::label('conference_calls', trans("admin/costsavings.conference_calls"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::number('conference_calls', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('conference_calls', ':message') }}</span>
            </div>
        </div>
        <div class="form-group">
        <button type="submit" class="btn btn-sm btn-success">
            <span class="glyphicon glyphicon-ok-circle"></span>
            @if	(isset($costsaving))
                {{ trans("admin/modal.edit") }}
            @else
                {{trans("admin/modal.create") }}
            @endif
        </button>
        </div>
    </div>
    {!! Form::close() !!}
    @endsection @section('scripts')

        <script type="text/javascript">
        </script>
</div>
@endsection
