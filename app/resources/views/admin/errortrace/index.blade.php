@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title') {!! trans("admin/errortrace.system_status") !!} :: @parent
@endsection

{{-- Content --}}
@section('main')
    <div class="page-header">
        <h3>
            {!! trans("admin/errortrace.errortrace") !!}
        </h3>
    </div>

    <table id="table" class="table table-striped table-hover">
        <thead>
        <tr>
            <th>{!! trans("admin/errortrace.user_email") !!}</th>
            <th>{!! trans("admin/errortrace.workspace") !!}</th>
            <th>{!! trans("admin/errortrace.message") !!}</th>
            <th>{!! trans("admin/errortrace.full_url") !!}</th>
            <th>{!! trans("admin/admin.created_at") !!}</th>
        </tr>
        </thead>
        <tbody></tbody>
    </table>
@endsection

{{-- Scripts --}}
@section('scripts')
@endsection
