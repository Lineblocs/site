@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title') {!! trans("admin/sipproviders.sip_providers") !!} :: @parent
@endsection

{{-- Content --}}
@section('main')
    <div class="page-header">
        <h3>
            {!! trans("admin/sipproviders.sip_providers") !!}
            <div class="pull-right">
                <div class="pull-right">
                    <a href="{!! url('admin/provider/create') !!}"
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
            <th>{!! trans("admin/sipproviders.name") !!}</th>
            <th>{!! trans("admin/sipproviders.active") !!}</th>
            <th>{!! trans("admin/sipproviders.country") !!}</th>
            <th>{!! trans("admin/sipproviders.type_of_provider") !!}</th>
            <th>{!! trans("admin/sipproviders.status") !!}</th>
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
