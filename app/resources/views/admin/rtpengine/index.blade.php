@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title') {!! trans("admin/rtpengines.rtp_proxies") !!} :: @parent
@endsection

{{-- Content --}}
@section('main')
    <div class="page-header">
        <h3>
            {!! trans("admin/rtpengines.rtp_engines") !!}
            <div class="pull-right">
                <div class="pull-right">
                    <a href="{!! url('admin/rtpengine/create') !!}"
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
            <th>{!! trans("admin/rtpengines.socket") !!}</th>
            <th>{!! trans("admin/rtpengines.cpu_pct") !!}</th>
            <th>{!! trans("admin/rtpengines.mem_pct") !!}</th>
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
