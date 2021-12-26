@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title') {!! trans("admin/rtpproxies.rtp_proxies") !!} :: @parent
@endsection

{{-- Content --}}
@section('main')
    <div class="page-header">
        <h3>
            {!! trans("admin/rtpproxies.rtp_proxies") !!}
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
            <th>{!! trans("admin/rtpproxies.rtpproxy_sock") !!}</th>
            <th>{!! trans("admin/rtpproxies.cpu_pct") !!}</th>
            <th>{!! trans("admin/rtpproxies.mem_pct") !!}</th>
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
