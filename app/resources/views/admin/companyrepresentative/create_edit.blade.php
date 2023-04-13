@extends('admin.layouts.modal')
{{-- Content --}}
@section('content')
        <!-- Tabs -->
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab"> {{
            trans("admin/modal.general") }}</a></li>
        </ul>
        <!-- ./ tabs -->
        @if (isset($companyrepresentative))
        {!! Form::model($companyrepresentative, array('url' => url('admin/companyrepresentative') . '/' . $companyrepresentative->id, 'method' => 'put', 'class' =>
        'bf',
        'files'=> true)) !!}
        @else
        {!! Form::open(array('url' => url('admin/companyrepresentative'), 'method' => 'post', 'class' => 'bf', 'files'=> true)) !!}
        @endif
        <!-- Tabs Content -->
        <div class="tab-content">
            <!-- General tab -->
            <div class="tab-pane active" id="tab-general">
                <div class="form-group  {{ $errors->has('name') ? 'has-error' : '' }}">
                    {!! Form::label('name', trans("admin/companyrepresentatives.name"), array('class' => 'control-label')) !!}
                    <div class="controls">
                        {!! Form::text('name', null, array('class' => 'form-control')) !!}
                        <span class="help-block">{{ $errors->first('name', ':message') }}</span>
                    </div>
                </div>
                <div class="form-group  {{ $errors->has('email_address') ? 'has-error' : '' }}">
                    {!! Form::label('email_address', trans("admin/companyrepresentatives.email_address"), array('class' => 'control-label')) !!}
                    <div class="controls">
                        {!! Form::text('email_address', null, array('class' => 'form-control')) !!}
                        <span class="help-block">{{ $errors->first('email_address', ':message') }}</span>
                    </div>
                </div>
                <div class="form-group  {{ $errors->has('main_contact') ? 'has-error' : '' }}">
                    {!! Form::label('main_contact', trans("admin/companyrepresentatives.main_contact"), array('class' => 'control-label')) !!}
                    <div class="controls">
                        {!! Form::label('main_contact', trans("admin/companyrepresentatives.yes"), array('class' => 'control-label')) !!}
                        {!! Form::radio('main_contact', '1', @isset($companyrepresentative)? $companyrepresentative->main_contact : 'false') !!}
                        {!! Form::label('main_contact', trans("admin/companyrepresentatives.no"), array('class' => 'control-label')) !!}
                        {!! Form::radio('main_contact', '0', @isset($companyrepresentative)? $companyrepresentative->main_contact : 'true') !!}
                        <span class="help-block">{{ $errors->first('main_contact', ':message') }}</span>
                    </div>
                </div>


            </div>
        </div>



        <div class="form-group">
            <button type="submit" class="btn btn-sm btn-success">
                <span class="glyphicon glyphicon-ok-circle"></span>
                @if (isset($companyrepresentative))
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
