@extends('admin.layouts.modal')
@section('content')
	{!! Form::model($serviceplan, array('url' => url('admin/serviceplan') . '/' . $serviceplan->id, 'method' => 'delete', 'class' => 'bf', 'files'=> true)) !!}
	@if (!$canDelete)
		<div class="alert alert-danger">{{ $message }}</div>
		<div class="form-group">
			<div class="controls">
				<element class="btn btn-warning btn-sm close_popup">
					<span class="glyphicon glyphicon-ban-circle"></span> {{ trans("admin/modal.cancel") }}
				</element>
			</div>
		</div>
	@else
	<div class="form-group">
		<div class="controls">
			{{ trans("admin/modal.delete_message") }}<br>
			<element class="btn btn-warning btn-sm close_popup">
				<span class="glyphicon glyphicon-ban-circle"></span> {{
			trans("admin/modal.cancel") }}</element>
			<button type="submit" class="btn btn-sm btn-danger">
				<span class="glyphicon glyphicon-trash"></span> {{
				trans("admin/modal.delete") }}
			</button>
		</div>
	</div>
	@endif
	{!! Form::close() !!}
@endsection
