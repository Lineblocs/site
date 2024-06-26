@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title') {!! trans("admin/tickets.numbers") !!} :: @parent
@endsection

{{-- Content --}}
@section('main')
    <div class="page-header">
        <h3>
            {!! trans("admin/tickets.tickets") !!}
            <div class="pull-right">
            </div>
        </h3>
    </div>

    <table id="table" class="table table-striped table-hover">
        <thead>
        <tr>
            <th>{!! trans("admin/tickets.subject") !!}</th>
            <th>{!! trans("admin/tickets.priority") !!}</th>
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
