@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title') {!! trans("admin/sipcountrys.edit_flow") !!} :: @parent
@endsection

{{-- Content --}}
@section('main')
    <div class="page-header">
        <h3>
            {!! trans("admin/flow.edit_flow") !!}
        </h3>
    </div>
    <iframe border="0" height="780" width="100%" src="{{\App\Helpers\MainHelper::createCallRouterEditingUrl(\Auth::user(), $flowId)}}"></iframe>

@endsection

{{-- Scripts --}}
@section('scripts')
@endsection
