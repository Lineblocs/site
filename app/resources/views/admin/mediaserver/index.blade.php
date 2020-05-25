@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title') {!! trans("admin/mediaservers.media_servers") !!} :: @parent
@endsection

{{-- Content --}}
@section('main')
    <div class="page-header">
        <h3>
            {!! trans("admin/mediaservers.media_servers") !!}
            <div class="pull-right">
                <div class="pull-right">
                    <a href="{!! url('admin/server/create') !!}"
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
            <th>{!! trans("admin/mediaservers.name") !!}</th>
            <th>{!! trans("admin/mediaservers.ip_address") !!}</th>
            <th>{!! trans("admin/mediaservers.ip_address_range") !!}</th>
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
