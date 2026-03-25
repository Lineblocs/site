@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')
<ul class="nav nav-tabs">
    <li class="active">
        <a href="#tab-general" data-toggle="tab">{{ trans("admin/modal.general") }}</a>
    </li>
    @if (!empty($workspace))
    <li>
        <a href="#tab-users" data-toggle="tab">{{ trans("admin/modal.users") }}</a>
    </li>
    <li>
        <a href="#tab-billing" data-toggle="tab">{{ trans("admin/modal.billing") }}</a>
    </li>
    <li>
        <a href="#tab-plan" data-toggle="tab">{{ trans("admin/modal.plandetails") }}</a>
    </li>
    @endif
</ul>

<input type="hidden" name="_token" value="{{ csrf_token() }}" />

@if (isset($workspace))
    {!! Form::model($workspace, array('url' => url('admin/workspace') . '/' . $workspace->id, 'method' => 'put', 'class' => 'bf', 'files'=> true)) !!}
@else
    {!! Form::open(array('url' => url('admin/workspace'), 'method' => 'post', 'class' => 'bf', 'files'=> true)) !!}
@endif

<div class="tab-content">
    <div class="tab-pane active" id="tab-general">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            {!! Form::label('name', trans("admin/workspaces.name"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('name', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('name', ':message') }}</span>
            </div>
        </div>
        <div class="form-group {{ $errors->has('active') ? 'has-error' : '' }}">
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
                {{ isset($workspace) ? trans("admin/modal.edit") : trans("admin/modal.create") }}
            </button>
        </div>
    </div>

    @if (isset($workspace))
    <div class="tab-pane" id="tab-users">
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
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="tab-pane" id="tab-billing">
        <div class="row">
            <div class="col-md-12">
                <h3>Billing Overview</h3>
                <p><strong>Account Balance:</strong> {{$billingInfo['accountBalance']}}<br><small>finalized invoices and payments</small></p>
                <p><strong>Charges this month:</strong> {{$billingInfo['chargesThisMonth']}}<br><small>invoiced {{$billingInfo['nextInvoiceDue']}}</small></p>
                <p><strong>Estimated balance:</strong> {{$billingInfo['estimatedBalance']}}<br><small>balance including charges this month.</small></p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h3>Invoices</h3>
                <table class="table stripped">
                    <thead>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Date/time</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @foreach ($invoices as $record)
                            <tr>
                                <td>{{$record['dollars']}}</td>
                                <td>
                                    @if ($record['status'] == 'COMPLETE')
                                        <i class="fa fa-check" style="color:green"></i> Paid
                                    @elseif ($record['status'] == 'INCOMPLETE')
                                        <i class="fa fa-times" style="color:red"></i> Unpaid
                                    @elseif ($record['status'] == 'REFUNDED')
                                        <i class="fa fa-undo" style="color:orange"></i> Refunded
                                    @endif
                                </td>
                                <td>{{$record['created_at']}}</td>
                                <td>
                                    @if ($record['status'] == 'COMPLETE')
                                        <button type="button" data-invoice-id="{{$record['id']}}" class="btn btn-sm btn-danger refund-trigger">Refund</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="tab-pane" id="tab-plan">
        <h3>Plan Details</h3>
        <p><strong>Plan:</strong> {{$billingInfo['limits']['nice_name']}}</p>
        <p><strong>Call duration:</strong> {{$billingInfo['limits']['call_duration']}}</p>
        <p><strong>Recording storage:</strong> {{$billingInfo['limits']['recording_space']}}</p>

        <h4>Routing ACLs</h4>
        <table class="table table-stripped">
            <thead>
                <th>ISO</th><th>Name</th><th>Risk Level</th><th>Enabled</th>
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
            <thead><th>Percentage</th><th>Created At</th></thead>
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
            <thead><th>Plan</th><th>Started At</th><th>Ended At</th></thead>
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

<div class="modal fade" id="refundConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="refundModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="refundModalLabel">Confirm Refund</h4>
            </div>
            <div class="modal-body">
                Are you sure you want to refund this payment ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmRefundSubmit">Confirm Refund</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(function () {
        var workspaceId = "{{ isset($workspace) ? $workspace->id : '' }}";
        var csrfToken = $('input[name="_token"]').val();
        var selectedInvoiceId = null;

        // When a refund button in the table is clicked
        $('.refund-trigger').on('click', function() {
            selectedInvoiceId = $(this).data('invoice-id');
            $('#refundConfirmationModal').modal('show');
        });

        // When the "Confirm Refund" button inside the modal is clicked
        $('#confirmRefundSubmit').on('click', function() {
            if (!selectedInvoiceId || !workspaceId) return;

            var $confirmBtn = $(this);
            $confirmBtn.prop('disabled', true).text('Processing...');

            var url = '/admin/workspace/' + workspaceId + '/refund_invoice';
            
            $.post(url, {
                invoice_id: selectedInvoiceId,
                _token: csrfToken
            }).done(function(response) {
                console.log('Refund successful:', response);
                // Refresh the page to reflect the new status
                //location.reload();
            }).fail(function(error) {
                console.error('Refund failed:', error);
                alert('There was an error processing the refund.');
            }).always(function() {
                $confirmBtn.prop('disabled', false).text('Confirm Refund');
                $('#refundConfirmationModal').modal('hide');
            });
        });
    });
</script>
@endsection