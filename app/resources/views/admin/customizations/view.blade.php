@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title') {!! trans("admin/callrates.call_rates") !!} :: @parent
@endsection

{{-- Content --}}
@section('main')
    <div class="page-header">
        <h3>
            {!! trans("admin/settings.settings") !!}
        </h3>
    </div>
    <div class="col-md-12">
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="row">
                <h3>Logos</h3>
                <hr/>
            </div>
            <div class="row form-group">
                <label for="app_logo">App logo</label>
                <div class="controls">
                    <input id="app_logo" type="file" class="form-control" name="app_logo" value=""/>
                    @if (!empty( $record->app_logo))
                        <a target="_blank" href="/assets/img/{{$record->app_logo}}">View current</a>
                    @endif
                </div>
            </div>
            <div class="row form-group">
                <label for="app_icon">Icon</label>
                <div class="controls">
                    <input id="app_icon" type="file" class="form-control" name="app_icon" value=""/>
                    @if (!empty( $record->app_icon))
                        <a target="_blank" href="/assets/img/{{$record->app_icon}}">View current</a>
                    @endif
                </div>
            </div>

            <div class="row form-group">
                <label for="admin_portal_logo">Admin portal logo</label>
                <div class="controls">
                    <input id="admin_portal_logo" type="file" class="form-control" name="admin_portal_logo" value=""/>
                    @if (!empty( $record->admin_portal_logo))
                        <a target="_blank" href="/assets/img/{{$record->admin_portal_logo}}">View current</a>
                    @endif
                </div>
            </div>
            <div class="row">
                <h3>Theme settings</h3>
                <hr/>
            </div>

            <div class="row form-group">
                <label for="color_scheme">Color scheme</label>
                <div class="controls">
                    <select name="color_scheme" class="form-control" id="color_scheme">
                        @if ( $record->color_scheme == 'standard')
                            <option value="standard" selected>Standard blue</option>
                        @else
                            <option value="standard">Standard blue</option>
                        @endif
                    </select>
                </div>
            </div>

            <div class="row form-group">
                <label for="layout_type">Layout type</label>
                <div class="controls">
                    <select name="layout_type" class="form-control" id="layout_type">
                        @if ( $record->color_scheme == 'normal')
                            <option value="normal" selected>Normal</option>
                        @else
                            <option value="normal">Normal</option>
                        @endif

                        <!--<option>Wide</option>-->
                        <!--<option>Compact</option>-->

                    </select>
                </div>
            </div>

            <div class="row form-group">
                <label for="primary_font">Primary font</label>
                <div class="controls">
                    <select name="primary_font" class="form-control" id="primary_font">
                        @if ( $record->primary_font == 'arial')
                            <option value="arial" selected>Arial</option>
                        @else
                            <option value="arial">Arial</option>
                        @endif
                        <!--<option>Wide</option>-->
                        <!--<option>Compact</option>-->
                    </select>
                </div>
            </div>


            <div class="row form-group">
                <label for="secondary_font">Secondary font</label>
                <div class="controls">
                    <select name="secondary_font" class="form-control" id="secondary_font">
                        @if ( $record->secondary_font == 'arial')
                            <option value="arial" selected>Arial</option>
                        @else
                            <option value="arial">Arial</option>
                        @endif
                        <!--<option>Wide</option>-->
                        <!--<option>Compact</option>-->
                    </select>
                </div>
            </div>



            <div class="row form-group">
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </form>
</div>
@endsection

{{-- Scripts --}}
@section('scripts')
@endsection
