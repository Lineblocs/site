@extends('admin.layouts.modal')
{{-- Content --}}
@section('content')
        <!-- Tabs -->
<ul class="nav nav-tabs">
    <li class="active"><a href="#tab-general" data-toggle="tab"> {{
            trans("admin/modal.general") }}</a></li>
            @if (!empty($workspace))
     <li><a href="#tab-users" data-toggle="tab"> {{
            trans("admin/modal.users") }}</a></li>
            @endif
            @if (!empty($workspace))
     <li><a href="#tab-billing" data-toggle="tab"> {{
            trans("admin/modal.billing") }}</a></li>
            @endif
          @if (!empty($workspace))
     <li><a href="#tab-plan" data-toggle="tab"> {{
            trans("admin/modal.plandetails") }}</a></li>
            @endif

</ul>
<!-- ./ tabs -->
@if (isset($workspace))
{!! Form::model($workspace, array('url' => url('admin/workspace') . '/' . $workspace->id, 'method' => 'put', 'class' => 'bf', 'files'=> true)) !!}
@else
{!! Form::open(array('url' => url('admin/workspace'), 'method' => 'post', 'class' => 'bf', 'files'=> true)) !!}
@endif
        <!-- Tabs Content -->
<div class="tab-content">
    <!-- General tab -->
    <div class="tab-pane active" id="tab-general">
        <div class="form-group  {{ $errors->has('name') ? 'has-error' : '' }}">
            {!! Form::label('name', trans("admin/workspaces.name"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('name', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('name', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('active') ? 'has-error' : '' }}">
            {!! Form::label('active', trans("admin/workspaces.active"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::label('active', trans("admin/admin.yes"), array('class' => 'control-label')) !!}
                {!! Form::radio('active', '1', @isset($workspace)? $workspace->active : 'false') !!}
                {!! Form::label('active', trans("admin/admin.no"), array('class' => 'control-label')) !!}
                {!! Form::radio('active', '0', @isset($workspace)? $workspace->active : 'true') !!}
                <span class="help-block">{{ $errors->first('confirmed', ':message') }}</span>
            </div>
        </div>
        <div class="form-group">
        <button type="submit" class="btn btn-sm btn-success">
            <span class="glyphicon glyphicon-ok-circle"></span>
            @if	(isset($workspace))
                {{ trans("admin/modal.edit") }}
            @else
                {{trans("admin/modal.create") }}
            @endif
        </button>
        </div>
    </div>
        @if (isset($workspace))
    <div class="tab-pane" id="tab-users">
        <div class="row">
            <div class="col-md-8">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table stripped">
                    <thead>
                        <th>Email</th>
                        <th>Joined At</th>
                        <th>&nbsp;</th>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{$user->email}}</td>
                                <td>{{$user->created_at->format('Y-m-d')}}</td>
                                <td>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
            @endif
       @if (isset($workspace))
    <div class="tab-pane" id="tab-billing">

        <div class="row">
            <div class="col-md-12">
                <h3>Billing Overview</h3>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <strong>Account Balance</strong> <span>{{$billingInfo['accountBalance']}}
                    <br/>
                    <small>finalized invoices and payments</small>
            </div>
     </div>
        <div class="row">
            <div class="col-md-12">
                <strong>Charges this month</strong> <span>{{$billingInfo['chargesThisMonth']}}
                    <br/>
                    <small>invoiced {{$billingInfo['nextInvoiceDue']}}</small>
            </div>
     </div>
        <div class="row">
            <div class="col-md-12">
                <strong>Estimated balance</strong> <span>{{$billingInfo['estimatedBalance']}}
                    <br/>
                    <small>balance including charges this month.</small>
            </div>
     </div>
        <div class="row">
            <div class="col-md-12">
                <h3>Billing History</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table stripped">
                    <thead>
                        <th>Source</th>
                        <th>Amount</th>
                        <th>Balance</th>
                        <th>Date/time</th>
                    </thead>
                    <tbody>
                        @foreach ($billingHistory as $record)
                            <tr>
                                <td>{{$record['type']}}</td>
                                <td>{{$record['dollars']}}</td>
                                <td>{{$record['balance']}}</td>
                                <td>{{$record['created_at']}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
            @endif
       @if (isset($workspace))
    <div class="tab-pane" id="tab-plan">
        <div class="row">
            <div class="col-md-12">
                <h3>Plan Details</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <strong>Plan</strong> <span>{{$billingInfo['limits']['nice_name']}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <strong>Call duration</strong> <span>{{$billingInfo['limits']['call_duration']}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <strong>Recording storage</strong> <span>{{$billingInfo['limits']['recording_space']}}
            </div>
        </div>
        <h4>Routing ACLs</h4>
        <table class="table table-stripped">
            <thead>
                <th>ISO</th>
                <th>Name</th>
                <th>Risk Level</th>
                <th>Enabled</th>
     </thead>
            <tbody>
                
        @foreach ($routingACLs as $item)
                <tr>
                    <td>{{$item['iso']}}</td>
                    <td>{{$item['name']}}</td>
                    <td>{{$item['risk_level']}}</td>
                    <td>{{$item['enabled']?'Yes':'No'}}</td>
     </tr>
        @endforeach
     </tbody>
     </table>


        <h4>Usage Triggers</h4>
        <table class="table table-stripped">
            <thead>
                <th>Percentage</th>
                <th>Created At</th>
     </thead>
            <tbody>
                
        @foreach ($usageTriggers as $trigger)
                <tr>
                    <td>{{$trigger->percentage}}</td>
                    <td>{{$trigger->created_at}}</td>
     </tr>
        @endforeach
     </tbody>
     </table>


        <h4>Plan History</h4>
        <table class="table table-stripped">
            <thead>
                <th>Plan</th>
                <th>Started At</th>
                <th>Ended At</th>
     </thead>
            <tbody>
                
        @foreach ($planHistory as $item)
                <tr>
                    <td>{{$item->plan}}</td>
                    <td>{{$item->started_at}}</td>
                    <td>{{$item->ended_at}}</td>
     </tr>
        @endforeach
     </tbody>
     </table>

     </div>
            @endif
    {!! Form::close() !!}
</div>
@endsection 
@section('scripts')
    <script type="text/javascript">
        $(function () {
            @if (!empty($workspace))
                var workspaceId = "{{$workspace->id}}";
            @else
                var workspaceId = null;
            @endif
        });
    </script>
@endsection
