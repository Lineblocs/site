@extends('admin.layouts.modal')
{{-- Content --}}
@section('content')
<div class="panel panel-default">
    <div class="panel-heading" style="background-color: #f5f5f5; border-bottom: 2px solid #ddd;">
        <h3 class="panel-title" style="margin: 0; font-weight: 600;">
            @if (isset($serviceplan))
                <i class="fa fa-edit" style="color: #0275d8;"></i> {{ trans("admin/modal.edit") }}
            @else
                <i class="fa fa-plus" style="color: #28a745;"></i> {{ trans("admin/modal.create") }}
            @endif
        </h3>
    </div>
    <div class="panel-body" style="padding: 25px;">
        <!-- Tabs -->
        <ul class="nav nav-tabs" role="tablist" style="border-bottom: 2px solid #ddd; margin-bottom: 25px;">
            <li class="active"><a href="#tab-general" data-toggle="tab" role="tab" style="border-radius: 4px 4px 0 0;"> 
                <i class="fa fa-cog"></i> {{ trans("admin/modal.general") }}
            </a></li>
            <li style="margin-left: 10px;"><a href="#tab-migrate" data-toggle="tab" role="tab" style="border-radius: 4px 4px 0 0;"> 
                <i class="fa fa-exchange"></i> {{ trans("admin/serviceplans.migrate_users") }}
            </a></li>
        </ul>
        <!-- ./ tabs -->
        
        @if (isset($serviceplan))
        {!! Form::model($serviceplan, array('url' => url('admin/serviceplan') . '/' . $serviceplan->id, 'method' => 'put', 'class' => 'bf', 'files'=> true)) !!}
        @else
        {!! Form::open(array('url' => url('admin/serviceplan'), 'method' => 'post', 'class' => 'bf', 'files'=> true)) !!}
        @endif
        
        <!-- Tabs Content -->
        <div class="tab-content" style="padding-top: 20px;">

    <!-- General tab -->
    <div class="tab-pane active" id="tab-general">
        <div class="form-group  {{ $errors->has('key_name') ? 'has-error' : '' }}">
            {!! Form::label('key_name', trans("admin/serviceplans.key_name"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('key_name', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('name', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('nice_name') ? 'has-error' : '' }}">
            {!! Form::label('nice_name', trans("admin/serviceplans.nice_name"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('nice_name', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('name', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('monthly_cost_cents') ? 'has-error' : '' }}">
            {!! Form::label('monthly_cost_cents', trans("admin/serviceplans.monthly_cost_cents"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('monthly_cost_cents', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('monthly_cost_cents', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('annual_cost_cents') ? 'has-error' : '' }}">
            {!! Form::label('annual_cost_cents', trans("admin/serviceplans.annual_cost_cents"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('annual_cost_cents', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('name', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('rank') ? 'has-error' : '' }}">
            {!! Form::label('rank', trans("admin/serviceplans.rank"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('rank', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('name', ':message') }}</span>
            </div>
        </div>

        <div class="form-group  {{ $errors->has('call_duration') ? 'has-error' : '' }}">
            {!! Form::label('call_duration', trans("admin/serviceplans.call_duration"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::select('call_duration', $callDurations, NULL, ['id' => 'callduration', 'class' => 'form-control']) !!}

                <span class="help-block">{{ $errors->first('name', ':message') }}</span>
            </div>
        </div>

        <div class="form-group  {{ $errors->has('recording_space') ? 'has-error' : '' }}">
            {!! Form::label('recording_space', trans("admin/serviceplans.recording_space"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::select('recording_space', $recordingSpace, NULL, ['id' => 'recordingspace', 'class' => 'form-control']) !!}
                <span class="help-block">{{ $errors->first('name', ':message') }}</span>
            </div>
        </div>

        <div class="form-group  {{ $errors->has('minutes_per_month') ? 'has-error' : '' }}">
            {!! Form::label('minutes_per_month', trans("admin/serviceplans.minutes_per_month"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('minutes_per_month', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('name', ':message') }}</span>
            </div>
        </div>

        <div class="form-group  {{ $errors->has('status') ? 'has-error' : '' }}">
            {!! Form::label('status', trans("admin/serviceplans.status"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::select('status', array_combine($statuses, $statuses), isset($serviceplan) ? $serviceplan->status : null, ['class' => 'form-control']) !!}
                <span class="help-block">{{ $errors->first('status', ':message') }}</span>
            </div>
        </div>

        <div class="form-group  {{ $errors->has('pay_as_you_go') ? 'has-error' : '' }}">
            {!! Form::label('pay_as_you_go', trans("admin/serviceplans.pay_as_you_go"), array('class' => 'control-label')) !!}
            <div class="controls">
                <div class="btn-group" role="group" data-toggle="buttons">
                    <label class="btn btn-warning {{ isset($serviceplan) && $serviceplan->pay_as_you_go ? 'active' : (!isset($serviceplan) ? 'active' : '') }}">
                        {!! form::radio('pay_as_you_go', '1', isset($serviceplan) ? $serviceplan->pay_as_you_go : true) !!}
                        {{ trans("admin/users.yes") }}
                    </label>
                    <label class="btn btn-warning {{ isset($serviceplan) && !$serviceplan->pay_as_you_go ? 'active' : '' }}">
                        {!! form::radio('pay_as_you_go', '0', isset($serviceplan) ? !$serviceplan->pay_as_you_go : false) !!}
                        {{ trans("admin/users.no") }}
                    </label>
                </div>
                <span class="help-block">{{ $errors->first('pay_as_you_go', ':message') }}</span>
            </div>
        </div>

        <div class="form-group  {{ $errors->has('allow_multiple_workspace_users') ? 'has-error' : '' }}">
            {!! Form::label('allow_multiple_workspace_users', trans("admin/serviceplans.allow_multiple_workspace_users"), array('class' => 'control-label')) !!}
            <div class="controls">
                <div class="btn-group" role="group" data-toggle="buttons">
                    <label class="btn btn-info {{ isset($serviceplan) && $serviceplan->allow_multiple_workspace_users ? 'active' : (!isset($serviceplan) ? 'active' : '') }}">
                        {!! form::radio('allow_multiple_workspace_users', '1', isset($serviceplan) ? $serviceplan->allow_multiple_workspace_users : true) !!}
                        {{ trans("admin/users.yes") }}
                    </label>
                    <label class="btn btn-info {{ isset($serviceplan) && !$serviceplan->allow_multiple_workspace_users ? 'active' : '' }}">
                        {!! form::radio('allow_multiple_workspace_users', '0', isset($serviceplan) ? !$serviceplan->allow_multiple_workspace_users : false) !!}
                        {{ trans("admin/users.no") }}
                    </label>
                </div>
                <span class="help-block">{{ $errors->first('allow_multiple_workspace_users', ':message') }}</span>
            </div>
        </div>

        <div class="form-group  {{ $errors->has('trial_ends_on_purchase') ? 'has-error' : '' }}">
            {!! Form::label('trial_ends_on_purchase', trans("admin/serviceplans.trial_ends_on_purchase"), array('class' => 'control-label')) !!}
            <div class="controls">
                <div class="btn-group" role="group" data-toggle="buttons">
                    <label class="btn btn-info {{ isset($serviceplan) && $serviceplan->trial_ends_on_purchase ? 'active' : (!isset($serviceplan) ? 'active' : '') }}">
                        {!! form::radio('trial_ends_on_purchase', '1', isset($serviceplan) ? $serviceplan->trial_ends_on_purchase : true) !!}
                        {{ trans("admin/users.yes") }}
                    </label>
                    <label class="btn btn-info {{ isset($serviceplan) && !$serviceplan->trial_ends_on_purchase ? 'active' : '' }}">
                        {!! form::radio('trial_ends_on_purchase', '0', isset($serviceplan) ? !$serviceplan->trial_ends_on_purchase : false) !!}
                        {{ trans("admin/users.no") }}
                    </label>
                </div>
                <span class="help-block">{{ $errors->first('trial_ends_on_purchase', ':message') }}</span>
            </div>
        </div>

        @foreach ( $features as $feature )
            <div class="form-group  {{ $errors->has($feature['key']) ? 'has-error' : '' }}">
                {!! form::label($feature['key'], trans("admin/serviceplans." . $feature['key']), array('class' => 'control-label')) !!}
                <div class="controls">
                    <div class="btn-group" role="group" data-toggle="buttons">
                        <label class="btn btn-info {{ @isset($serviceplan) && $serviceplan->{$feature['key']} ? 'active' : '' }}">
                            {!! form::radio($feature['key'], '1', @isset($serviceplan)? $serviceplan->{$feature['key']} : 'false') !!}
                            {{ trans("admin/users.yes") }}
                        </label>
                        <label class="btn btn-info {{ @isset($serviceplan) && !$serviceplan->{$feature['key']} ? 'active' : '' }}">
                            {!! form::radio($feature['key'], '0', @isset($serviceplan)? !$serviceplan->{$feature['key']} : 'true') !!}
                            {{ trans("admin/users.no") }}
                        </label>
                    </div>
                    <span class="help-block">{{ $errors->first($feature['key'], ':message') }}</span>
                </div>
            </div>
        @endforeach
        <div class="form-group">
        <button type="submit" class="btn btn-sm btn-success">
            <span class="glyphicon glyphicon-ok-circle"></span>
            @if	(isset($serviceplan))
                {{ trans("admin/modal.edit") }}
            @else
                {{trans("admin/modal.create") }}
            @endif
        </button>
        </div>


    </div>
    <div class="tab-pane" id="tab-migrate">
        @if (isset($serviceplan))
            {!! Form::open(array('url' => url('admin/serviceplan/' . $serviceplan->id . '/migrate'), 'method' => 'post', 'class' => 'bf')) !!}
            <div class="alert alert-warning" style="margin-top: 20px; margin-bottom: 20px;">
                <p>{{ trans("admin/serviceplans.migrate_warning") }}</p>
            </div>
            <div class="form-group">
                {!! Form::label('migrate_plan', trans("admin/serviceplans.select_plan"), array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::select('migrate_plan', $migratePlans, null, ['class' => 'form-control', 'placeholder' => trans("admin/serviceplans.select_plan")]) !!}
                </div>
            </div>
            <div class="form-group">
                <button type="submit" name="action" value="migrate" class="btn btn-sm btn-danger">
                    <span class="glyphicon glyphicon-transfer"></span>
                    {{ trans("admin/serviceplans.migrate_users") }}
                </button>
            </div>
            {!! Form::close() !!}
        @else
            <p>{{ trans("admin/serviceplans.save_first_to_migrate") }}</p>
        @endif
    </div>
    {!! Form::close() !!}
    @endsection @section('scripts')

        <script type="text/javascript">
        </script>
</div>
@endsection
