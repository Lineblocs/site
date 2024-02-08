@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title') {!! trans("admin/customizations.customizations") !!} :: @parent
@endsection

{{-- Content --}}
@section('main')
    <div class="page-header">
        <h3>
            {!! trans("admin/routingeditor.routing_editor") !!}
        </h3>
    </div>
    <div class="col-md-12">
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="row form-group">
                <div class="controls">
                    @if ( $record->priority_aware_packet_policing )
                        <input id="priority_aware_packet_policing" type="checkbox"  name="priority_aware_packet_policing" checked/>
                    @else
                        <input id="priority_aware_packet_policing" type="checkbox"  name="priority_aware_packet_policing"/>
                    @endif
                    <label>Priority Aware Packet Policing</label>
                </div>
            </div>



            <div class="row form-group">
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </form>
</div>
@endsection