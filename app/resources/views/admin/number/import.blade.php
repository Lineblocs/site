@extends('admin.layouts.modal')
{{-- Content --}}
@section('content')
<div class="tab-content">
    <!-- General tab -->
    <h3>Upload numbers</h3>
    <div class="tab-pane active" id="tab-general">

        <p>
            Please upload file using a supported format (.CSV, .TSV). To view an example of the file format, please click 
            <a href="/admin/number/sample" target="_blank">here</a>
        </p>
        <hr/>
        <form id="fupload" action="" method="POST" enctype="multipart/form-data">
            <div class="form-group  {{ $errors->has('number') ? 'has-error' : '' }}">
                <label>Select file</label>
                <input type="file" name="file"/>
            </div>
            <div class="form-group">

            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <button type="submit" class="btn btn-sm btn-success">
                <span class="glyphicon glyphicon-ok-circle"></span>
                {{ trans("admin/modal.upload") }}
            </button>
            </div>
        </form>
    </div>

    {!! Form::close() !!}
</div>
@endsection
