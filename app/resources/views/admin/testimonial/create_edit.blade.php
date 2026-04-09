@extends('admin.layouts.modal')
@section('content')
       
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab"> {{
            trans("admin/modal.general") }}</a></li>
        </ul>
        @if (isset($testimonial))
        {!! Form::model($testimonial, array('url' => url('admin/testimonial') . '/' . $testimonial->id, 'method' => 'put', 'class' => 'bf', 'files'=> true, 'id' => 'fupload')) !!}
        @else
        {!! Form::open(array('url' => url('admin/testimonial'), 'method' => 'post', 'class' => 'bf', 'files'=> true, 'id' => 'fupload')) !!}
        @endif
        <div class="tab-content">
            <div class="tab-pane active" id="tab-general">
                <div class="form-group ">
                    {!! Form::label('rank', trans("admin/testimonials.rank"), array('class' => 'control-label')) !!}
                    <div class="controls">
                        {!! Form::number('rank', 0, array('class' => 'form-control')) !!}
                        <span class="help-block">{{ $errors->first('rank', ':message') }}</span>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('name', trans("admin/testimonials.name"), array('class' => 'control-label')) !!}
                    <div class="controls">
                        {!! Form::text('name', null, array('class' => 'form-control')) !!}
                        <span class="help-block">{{ $errors->first('name', ':message') }}</span>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('job_title', trans("admin/testimonials.job_title"), array('class' => 'control-label')) !!}
                    <div class="controls">
                        {!! Form::text('job_title', null, array('class' => 'form-control')) !!}
                        <span class="help-block">{{ $errors->first('job_title', ':message') }}</span>
                    </div>
                </div>

                <div class="form-group ">
                    {!! Form::label('company', trans("admin/testimonials.company"), array('class' => 'control-label')) !!}
                    <div class="controls">
                        {!! Form::text('company', null, array('class' => 'form-control')) !!}
                        <span class="help-block">{{ $errors->first('company', ':message') }}</span>
                    </div>
                </div>

                <div class="form-group ">
                    {!! Form::label('photo', trans("admin/testimonials.photo"), array('class' => 'control-label')) !!}
                    <div class="controls">
                        {!! Form::file('photo', array('class' => 'form-control')) !!}
                        <span class="help-block">{{ $errors->first('photo', ':message') }}</span>
                        @if (isset($testimonial) && !empty($testimonial->photo))
                            <div style="margin-top: 10px;">
                                <img src="{{ asset('images/testimonials/' . $testimonial->photo) }}" alt="{{ $testimonial->name }}" style="max-width: 180px; height: auto;" />
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('testimonial_content', trans("admin/testimonials.testimonial_content"), array('class' => 'control-label')) !!}
                    <div class="controls">
                        {!! Form::textarea('testimonial_content', null, array('class' => 'form-control', 'rows' => 6)) !!}
                        <span class="help-block">{{ $errors->first('testimonial_content', ':message') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-sm btn-success">
                <span class="glyphicon glyphicon-ok-circle"></span>
                @if (isset($testimonial))
                {{ trans("admin/modal.edit") }}
                @else
                {{trans("admin/modal.create") }}
                @endif
            </button>
        </div>

    {!! Form::close() !!}
@endsection

@section('scripts')
    <script type="text/javascript">
    </script>
@endsection
