@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title') {!! trans("admin/resourcesection.resource_sections") !!} :: @parent
@endsection

{{-- Content --}}
@section('main')
    <div class="page-header">
        <h3>
            {!! trans("admin/resourcesections.resource_sections") !!}
            <div class="pull-right">
                <div class="pull-right">
                    <a href="{!! url('admin/resourcesection/create') !!}"
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
            <th>{!! trans("admin/resourcesections.name") !!}</th>
            <th>{!! trans("admin/resourcesections.description") !!}</th>
            <th>{!! trans("admin/admin.created_at") !!}</th>
            <th>&nbsp;</th>
            <th>{!! trans("admin/admin.action") !!}</th>
        </tr>
        </thead>
        <tbody></tbody>
    </table>
@endsection

{{-- Scripts --}}
@section('scripts')
@endsection
