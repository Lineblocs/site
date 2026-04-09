@extends('admin.layouts.default')

@section('title') {!! trans("admin/testimonials.testimonials") !!} :: @parent
@endsection

@section('main')
    <div class="page-header">
        <h3>
            {!! trans("admin/testimonials.testimonials") !!}
            <div class="pull-right">
                <div class="pull-right">
                    <a href="{!! url('admin/testimonial/create') !!}"
                       class="btn btn-sm btn-primary iframe"><span
                                class="glyphicon glyphicon-plus-sign"></span> {{
					trans("admin/modal.new") }}</a>
                </div>
            </div>
        </h3>
    </div>

    <table id="table" class="table table-striped table-hover">
        <thead>
        <tr>
            <th>{!! trans("admin/testimonials.rank") !!}</th>
            <th>{!! trans("admin/testimonials.name") !!}</th>
            <th>{!! trans("admin/testimonials.job_title") !!}</th>
            <th>{!! trans("admin/testimonials.company") !!}</th>
            <th>{!! trans("admin/admin.created_at") !!}</th>
            <th>{!! trans("admin/admin.action") !!}</th>
        </tr>
        </thead>
        <tbody></tbody>
    </table>
@endsection

@section('scripts')
@endsection
