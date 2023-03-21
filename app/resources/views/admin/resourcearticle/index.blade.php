@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title')
    {!! trans('admin/resourcearticles.resource_articles') !!} :: @parent
@endsection

{{-- Content --}}
@section('main')
    <div class="page-header">
        <h3>
            {!! trans('admin/resourcearticles.resource_articles') !!}
            <div class="pull-right">
                <div class="pull-right">
                    <a href="{!! url('admin/resourcearticle/create') !!}" class="btn btn-sm  btn-primary iframe"><span
                            class="glyphicon glyphicon-plus-sign"></span> {{ trans('admin/modal.new') }}</a>
                </div>
            </div>
        </h3>
    </div>

    <table id="table" class="table table-striped table-hover">
        <thead>
            <tr>
                <th>{!! trans('admin/resourcearticles.name') !!}</th>
                <th>{!! trans('admin/resourcearticles.section_id') !!}</th>
                <th>{!! trans('admin/admin.active') !!}</th>
                <th>{!! trans('admin/admin.created_at') !!}</th>
                <th>{!! trans('admin/admin.action') !!}</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
@endsection

{{-- Scripts --}}
@section('scripts')
    <script>
        $(".iframe").colorbox({
            iframe: true,
            width: "80%",
            height: "80%",
            onClosed: function() {
                oTable.ajax.reload();
            }
        });
    </script>
@endsection
