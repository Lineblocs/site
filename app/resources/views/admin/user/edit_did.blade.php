@extends('admin.layouts.modal')
{{-- Content --}}
@section('content')
        <!-- Tabs -->
<ul class="nav nav-tabs">
    <li class="active"><a href="#tab-general" data-toggle="tab"> {{
            trans("admin/modal.general") }}</a></li>
</ul>
<!-- ./ tabs -->
{!! Form::model($did, array('url' => url('admin/user') . '/' . $user->id .  '/did/' . $did->id . '/edit', 'method' => 'put', 'class' => 'bf', 'close' => 'no', 'next' => '/admin/user/' . $user->id . '/edit', 'files'=> true)) !!}
 
        <!-- Tabs Content -->
<div class="tab-content">
    <!-- General tab -->
    <div class="tab-pane active" id="tab-general">
        <div class="form-group  {{ $errors->has('name') ? 'has-error' : '' }}">
            {!! Form::label('number', trans("admin/dids.name"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('name', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('name', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('active') ? 'has-error' : '' }}">
            {!! Form::label('active', trans("admin/dids.active"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::label('active', trans("admin/users.yes"), array('class' => 'control-label')) !!}
                {!! Form::radio('active', '1', @isset($user)? $user->active : 'false') !!}
                {!! Form::label('active', trans("admin/users.no"), array('class' => 'control-label')) !!}
                {!! Form::radio('active', '0', @isset($user)? $user->active : 'true') !!}
                <span class="help-block">{{ $errors->first('active', ':message') }}</span>
            </div>
        </div>
        <div class="form-group">
        <button type="submit" class="btn btn-sm btn-success">
            <span class="glyphicon glyphicon-ok-circle"></span>
            @if	(isset($user))
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
            $(function () {
                $("#roles").select2()
            });
        </script>
</div>
@endsection
