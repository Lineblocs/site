@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title') {!! trans("admin/workspaces.sip_workspaces") !!} :: @parent
@endsection

{{-- Content --}}
@section('main')
    <div class="page-header">
        <h3>
            {!! trans("admin/workspaces.workspaces") !!}
            <div class="pull-right">
                <div class="pull-right">
                </div>
            </div>
        </h3>
    </div>

    <table id="table" class="table table-striped table-hover">
        <thead>
        <tr>
            <th>{!! trans("admin/workspaces.name") !!}</th>
            <th>{!! trans("admin/workspaces.active") !!}</th>
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
