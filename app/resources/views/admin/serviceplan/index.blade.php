@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title') {!! trans("admin/serviceplans.service_plans") !!} :: @parent
@endsection

{{-- Content --}}
@section('main')
    <div class="page-header">
        <h3>
            {!! trans("admin/serviceplans.service_plans") !!}
            <div class="pull-right">
                <div class="pull-left button-margin">
                    <a href="{!! url('admin/serviceplan/create') !!}"
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
            <th>{!! trans("admin/serviceplans.key_name") !!}</th>
            <th>{!! trans("admin/serviceplans.nice_name") !!}</th>
            <th>{!! trans("admin/serviceplans.featured_plan") !!}</th>
            <th>{!! trans("admin/admin.created_at") !!}</th>
            <th>{!! trans("admin/admin.action") !!}</th>
        </tr>
        </thead>
        <tbody></tbody>
    </table>
@endsection

{{-- Scripts --}}
@section('scripts')
@endsection
