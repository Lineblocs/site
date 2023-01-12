@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title') {!! trans("admin/dnsrecords.dns_records") !!} :: @parent
@endsection

{{-- Content --}}
@section('main')
    <div class="page-header">
        <h3>
            {!! trans("admin/dnsrecords.dns_records") !!}
            <div class="pull-right">
                <div class="pull-right">
                    <a href="{!! url('admin/dns/create') !!}"
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
            <th>{!! trans("admin/dnsrecords.host") !!}</th>
            <th>{!! trans("admin/dnsrecords.type") !!}</th>
            <th>{!! trans("admin/dnsrecords.value") !!}</th>
            <th>{!! trans("admin/dnsrecords.ttl") !!}</th>
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
