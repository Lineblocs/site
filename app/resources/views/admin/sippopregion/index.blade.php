@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title') {!! trans("admin/sippopregions.sip_pop_regions") !!} :: @parent
@endsection

{{-- Content --}}
@section('main')
    <div class="page-header">
        <h3>
            {!! trans("admin/sippopregions.sip_pop_regions") !!}
            <div class="pull-right">
                <div class="pull-right">
                    <a href="{!! url('admin/popregion/create') !!}"
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
            <th>{!! trans("admin/sippopregions.name") !!}</th>
            <th>{!! trans("admin/sippopregions.code") !!}</th>
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