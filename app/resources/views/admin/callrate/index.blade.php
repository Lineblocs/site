@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title') {!! trans("admin/callrates.ratedeck") !!} :: @parent
@endsection

{{-- Content --}}
@section('main')
    <div class="page-header">
        <h3>
            {!! trans("admin/callrates.ratedeck") !!}
            <div class="pull-right">
                <div class="pull-left button-margin">
                    <a href="{!! url('admin/rate/create') !!}"
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
            <th>{!! trans("admin/callrates.name") !!}</th>
            <th>{!! trans("admin/callrates.type") !!}</th>
            <th>{!! trans("admin/callrates.default_call_rate") !!}</th>
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
