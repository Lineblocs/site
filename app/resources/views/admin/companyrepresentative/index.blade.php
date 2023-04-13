@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title') {!! trans("admin/companyrepresentatives.companyrepresentatives") !!} :: @parent
@endsection

{{-- Content --}}
@section('main')
    <div class="page-header">
        <h3>
            {!! trans("admin/companyrepresentatives.companyrepresentatives") !!}
            <div class="pull-right">
                <div class="pull-right">
                    <a href="{!! url('admin/companyrepresentative/create') !!}"
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
            <th>{!! trans("admin/companyrepresentatives.name") !!}</th>
            <th>{!! trans("admin/companyrepresentatives.email_address") !!}</th>
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
