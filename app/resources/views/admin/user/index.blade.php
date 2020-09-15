@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title') {!! trans("admin/users.users") !!} :: @parent
@endsection

{{-- Content --}}
@section('main')
    <div class="page-header">
        <h3>
            {!! trans("admin/users.users") !!}
            <div class="pull-right">
                <div class="pull-right">
                    <a href="{!! url('admin/user/create') !!}"
                       class="btn btn-sm  btn-primary iframe"><span
                                class="glyphicon glyphicon-plus-sign"></span> {{
					trans("admin/modal.new") }}</a>
                </div>
            </div>
        </h3>
    </div>

    <table id="table" class="table table-striped table-hover">
        <thead>
        <tr>
            <th>{!! trans("admin/users.first_name") !!}</th>
            <th>{!! trans("admin/users.last_name") !!}</th>
            <th>{!! trans("admin/users.email") !!}</th>
			<th>{!! trans("admin/users.active_user") !!}</th>
            <th>{!! trans("admin/users.plan") !!}</th>
            <th>{!! trans("admin/admin.created_at") !!}</th>
            <th>{!! trans("admin/admin.action") !!}</th>
        </tr>
        </thead>
        <tbody></tbody>
    </table>
@endsection

{{-- Scripts --}}
@section('scripts')
<script>
	var oTableColumns = [
		{
			"data": "first_name",
			"name": "first_name"
		},
		{
			"data": "last_name",
			"name": "last_name"
		},
		{
			"data": "email",
			"name": "email"
		},
		{
			"data": "confirmed",
			"name": "confirmed"
		},
		{
			"data": "plan",
			"name": "plan"
		},

		{
			"data": "created_at",
			"name": "created_at"
		},
		{
			"data": "actions",
			"name": "actions"
		},

];
	</script>
@endsection
