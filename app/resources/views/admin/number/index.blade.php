@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title') {!! trans("admin/numbers.numbers") !!} :: @parent
@endsection

{{-- Content --}}
@section('main')
    <div class="page-header">
        <h3>
            {!! trans("admin/numbers.numbers") !!}
            <div class="pull-right">
                <div class="pull-left button-margin">
                    <a href="{!! url('admin/number/create') !!}"
                       class="btn btn-sm  btn-primary iframe"><span
                                class="glyphicon glyphicon-plus-sign"></span> {{
					trans("admin/modal.new") }}</a>
                </div>
                <div class="pull-left">
                    <a href="{!! url('admin/number/import') !!}"
                       class="btn btn-sm  btn-primary iframe"><span
                                class="glyphicon glyphicon-plus-sign"></span> {{
					trans("admin/modal.import") }}</a>
                </div>
            </div>
        </h3>
    </div>

    <table id="table" class="table table-striped table-hover">
        <thead>
        <tr>
            <th>{!! trans("admin/numbers.number") !!}</th>
            <th>{!! trans("admin/numbers.region") !!}</th>
            <th>{!! trans("admin/numbers.provider") !!}</th>
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
