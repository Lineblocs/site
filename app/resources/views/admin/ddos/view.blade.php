@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title') {!! trans("admin/customizations.customizations") !!} :: @parent
@endsection

{{-- Content --}}
@section('main')
    <div class="page-header">
        <h3>
            {!! trans("admin/settings.ddos_settings") !!}
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
                <div class="controls">
                    @if ( $record->media_packet_policing )
                        <input id="media_packet_policing" type="checkbox"  name="media_packet_policing" checked/>
                    @else
                        <input id="media_packet_policing" type="checkbox"  name="media_packet_policing"/>
                    @endif
                    <label>Media Packet Policing</label>
                </div>
            </div>

            <div class="row form-group">
                <div class="controls">
                    @if ( $record->media_address_learning )
                        <input id="media_address_learning" type="checkbox"  name="media_address_learning" checked/>
                    @else
                        <input id="media_address_learning" type="checkbox"  name="media_address_learning"/>
                    @endif
                    <label>Media Address Learning</label>
                </div>
            </div>
            <div class="row form-group">
                <div class="controls">
                    @if ( $record->application_level_cac )
                        <input id="application_level_cac" type="checkbox"  name="application_level_cac" checked/>
                    @else
                        <input id="application_level_cac" type="checkbox"  name="application_level_cac"/>
                    @endif
                    <label>Application Level CAC</label>
                </div>
            </div>



            <div class="row form-group">
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </form>
</div>
@endsection