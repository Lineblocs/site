@extends('admin.layouts.modal')
{{-- Content --}}
@section('content')
<!-- Tabs -->
<ul class="nav nav-tabs">
    <li class="active"><a href="#tab-general" data-toggle="tab"> {{
            trans("admin/modal.general") }}</a></li>
            @if (isset($user))
    <li class=""><a href="#tab-workspaces" data-toggle="tab"> {{
            trans("admin/modal.workspaces") }}</a></li>
    <li class=""><a href="#tab-dids" data-toggle="tab"> {{
            trans("admin/modal.dids") }}</a></li>
    <li class=""><a href="#tab-routingflows" data-toggle="tab"> {{
            trans("admin/modal.routing_flows") }}</a>
    <li class=""><a href="#tab-billing" data-toggle="tab"> {{
			trans("admin/modal.billing") }}</a></li>
    <li class=""><a href="#tab-ports" data-toggle="tab"> {{
            trans("admin/modal.ports") }}</a></li>
    <li class=""><a href="#tab-sendemail" data-toggle="tab"> {{
            trans("admin/modal.sendemail") }}</a></li>
            @endif
</ul>
<!-- ./ tabs -->
@if (isset($user))
{!! Form::model($user, array('url' => url('admin/user') . '/' . $user->id, 'method' => 'put', 'class' => 'bf', 'files'=>
true)) !!}
@else
{!! Form::open(array('url' => url('admin/user'), 'method' => 'post', 'class' => 'bf', 'files'=> true)) !!}
@endif
<!-- Tabs Content -->
<div class="tab-content">
    <!-- General tab -->
    <div class="tab-pane active" id="tab-general">
        <div class="form-group  {{ $errors->has('first_name') ? 'has-error' : '' }}">
            {!! Form::label('first_name', trans("admin/users.first_name"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('first_name', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('first_name', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('last_name') ? 'has-error' : '' }}">
            {!! Form::label('last_name', trans("admin/users.last_name"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('last_name', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('last_name', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('job_title') ? 'has-error' : '' }}">
            {!! Form::label('job_title', trans("admin/users.job_title"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('job_title', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('job_title', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('username') ? 'has-error' : '' }}">
            {!! Form::label('username', trans("admin/users.username"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('username', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('username', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('email') ? 'has-error' : '' }}">
            {!! Form::label('email', trans("admin/users.email"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('email', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('email', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('mobile_number') ? 'has-error' : '' }}">
            {!! Form::label('mobile_number', trans("admin/users.mobile_number"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('mobile_number', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('mobile_number', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('office_number') ? 'has-error' : '' }}">
            {!! Form::label('office_number', trans("admin/users.office_number"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('office_number', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('office_number', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('password') ? 'has-error' : '' }}">
            {!! Form::label('password', trans("admin/users.password"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::password('password', array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('password', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
            {!! Form::label('password_confirmation', trans("admin/users.password_confirmation"), array('class' =>
            'control-label')) !!}
            <div class="controls">
                {!! Form::password('password_confirmation', array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('password_confirmation', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('address_line_1') ? 'has-error' : '' }}">
            {!! Form::label('address_line_1', trans("admin/users.address_line_1"), array('class' => 'control-label'))
            !!}
            <div class="controls">
                {!! Form::text('address_line_1', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('address_line_1', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('address_line_2') ? 'has-error' : '' }}">
            {!! Form::label('address_line_2', trans("admin/users.address_line_2"), array('class' => 'control-label'))
            !!}
            <div class="controls">
                {!! Form::text('address_line_2', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('address_line_2', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('city') ? 'has-error' : '' }}">
            {!! Form::label('city', trans("admin/users.city"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('city', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('city', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('state') ? 'has-error' : '' }}">
            {!! Form::label('city', trans("admin/users.state"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('state', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('state', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('postal_code') ? 'has-error' : '' }}">
            {!! Form::label('postal_code', trans("admin/users.postal_code"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('postal_code', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('postal_code', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('country') ? 'has-error' : '' }}">
            {!! Form::label('country', trans("admin/users.country"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::select('country', $countries, null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('state', ':message') }}</span>
            </div>
        </div>





        <div class="form-group  {{ $errors->has('confirmed') ? 'has-error' : '' }}">
            {!! Form::label('confirmed', trans("admin/admin.active"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::label('confirmed', trans("admin/users.yes"), array('class' => 'control-label')) !!}
                {!! Form::radio('confirmed', '1', @isset($user)? $user->confirmed : 'false') !!}
                {!! Form::label('confirmed', trans("admin/users.no"), array('class' => 'control-label')) !!}
                {!! Form::radio('confirmed', '0', @isset($user)? $user->confirmed : 'true') !!}
                <span class="help-block">{{ $errors->first('confirmed', ':message') }}</span>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-sm btn-success">
                <span class="glyphicon glyphicon-ok-circle"></span>
                @if (isset($user))
                {{ trans("admin/modal.edit") }}
                @else
                {{trans("admin/modal.create") }}
                @endif
            </button>
        </div>

    {!! Form::close() !!}
    </div>
    @if (isset($user))
        <!-- General tab -->
        <div class="tab-pane" id="tab-workspaces">
            <h5>Workspaces</h5>
            <table class="table stripped">
                <thead>
                    <th>Name</th>
                    <th>Creator</th>
                </thead>
                <tbody>
                    @foreach ($workspaces as $workspace)
                    <tr>
                        <td>{{$workspace->name}}</td>
                        <td>{{$workspace->creator_email}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- DIDs tab -->
        <div class="tab-pane" id="tab-dids">
            <h5>DID Numbers</h5>
            <table class="table stripped">
                <thead>
                    <th>Number</th>
                    <th>Name</th>
                    <th>Active</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach ($dids as $did)
                    <tr>
                        <td>{{$did->number}}</td>
                        <td>{{$did->name}}</td>
                        <td>{{$did->active}}</td>
                        <td>{{$did->created_at}}</td>
                        <td>
                            <a href="/admin/user/{{$user->id}}/did/{{$did->id}}/edit" class="btn btn-primary">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- routing flows tab -->
        <div class="tab-pane" id="tab-routingflows">
            <table class="table stripped">
                <thead>
                    <th>Country</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach ($sipcountries as $country)
                    <tr>
                        <td>{{$country->name}}</td>
                        @if ( !empty( $country->wflow_id)  )
                        <td>
                            <a target="_blank" href="/admin/user/{{$country->wflow_id}}/flow" class="btn btn-primary">Edit</a>
                        </td>f
                        @else
                        <td>
                            <a target="_blank" href="/admin/user/createFlowForCountry?countryiso={{$country->iso}}" class="btn btn-primary">Create</a>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Billing history tab -->

        <div class="tab-pane" id="tab-billing">
            <h3>Billing Overview</h3>
            <h5>Plan {{$user['plan']}}</h5>
            <h5>Remaining Balance {{$billingInfo['remainingBalance']}}</h5>
            <h5>Account Balance {{$billingInfo['accountBalance']}}</h5>
            <small>
                finalized invoices and payments
            </small>
            <h5>Charges This Month {{$billingInfo['chargesThisMonth']}}</h5>
            <small>
                invoiced {{$billingInfo['nextInvoiceDue']}}
            </small>
            <h5>Estimated Balance {{$billingInfo['estimatedBalance']}}</h5>
            <small>
                balance including charges this month.
            </small>
            <h3>Limits</h3>
            <h5>Call Duration: {{$billingInfo['limits']['call_duration']}}</h5>
            <br />
            <h5>Recording space: {{$billingInfo['limits']['recording_space']}}</h5>
            <hr />

            <h2>Billing History</h2>
            <table class="table stripped">
                <thead>
                    <th>Source</th>
                    <th>Amount</th>
                    <th>Balance</th>
                    <th>Date/Time</th>
                </thead>
                <tbody>
                    @foreach ($billingHistory as $item)
                    <tr>
                        <td>{{$item['type']}}</td>
                        <td>{{$item['dollars']}}</td>
                        <td>{{$item['balance']}}</td>
                        <td>{{$item['created_at']}}</td>
                        <td>{{$item['status']}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Port-in requests tab -->
        <div class="tab-pane" id="tab-ports">
            <h3>Port-In Requests</h3>
            <table class="table stripped">
                <thead>
                    <th>Number</th>
                    <th>Provider</th>
                    <th>Created Date</th>
                    <th>Updated Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach ($ports as $port)
                    <tr>
                        <td>{{$port->number}}</td>
                        <td>{{$port->provider}}</td>
                        <td>{{$port->created_at}}</td>
                        <td>{{$port->updated_at}}</td>
                        <td>{{$port->status}}</td>
                        <td>
                            <a class="btn-primary btn-sm btn-warn"
                                href="/admin/user/{{$user->id}}/port/{{$port->id}}/edit">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="tab-pane" id="tab-sendemail">

        <form action="/admin/user/{{$user->id}}/send_email" method="POST" name="send_email_frm" data-use-default-ajax="no">
                <h3>Send Email</h3>
                    <select class="form-control" id="cannedEmail">
                        <option value="">Select Canned Email Template</option>
                        @foreach ($cannedEmails as $email)
                            <option value="{{$email['value']}}">{{$email['name']}}</option>
                        @endforeach
                    </select>
                    <hr/>
                <input type="text" class="form-control" placeholder="Subject" name="email_subject"/>
                <input type="hidden" id="_token" value="{{csrf_token()}}" />
                <textarea class="form-control" name="email_body"></textarea>
                <button type="submit" class="btn btn-primary">Send</button>
                </form>
        </div>
    @endif
    @endsection @section('scripts')
    <script type="text/javascript">
        $(function () {
                var emails = [];
                @if (isset($cannedEmails))
                    var emails = {!! json_encode($cannedEmails) !!};
                @endif
                $("#cannedEmail").on("change", function() {
                    console.log("changed canned email...");
                    var selected = $( this ).find(":selected");
                    emails.forEach(function(email) {
                        if ( email.value === selected.val() ) {
                            $("input[name='email_subject']").val( email.email_subject );
                            $("textarea[name='email_body']").summernote('reset');
                            $("textarea[name='email_body']").summernote('editor.pasteHTML', email.email_body); 

                        }
                    })

                });
                $("form[name='send_email_frm']").submit(function(event) {
                    console.log("submitted form..");
                    event.preventDefault();
                    var data = {
                        _token: $( "#_token" ).val(),
                        subject: $( this ).find("input[name='email_subject']").val(),
                        body: $( this ).find("textarea[name='email_body']").summernote('code')
                    };
                    $.ajax({
                        type: 'POST',
                        url: $( this ).attr('action'),
                        data: data
                    }).success(function () {
                        alert("email sent successfully..");
                    });
                })
        });
    </script>
</div>
@endsection
