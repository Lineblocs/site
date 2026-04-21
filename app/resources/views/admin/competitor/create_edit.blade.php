@extends('admin.layouts.modal')

@section('content')

<style>
.well {
    text-align: left;
}
</style>
<ul class="nav nav-tabs">
    <li class="active"><a href="#tab-general" data-toggle="tab">{{ trans("admin/modal.general") }}</a></li>
    @if(isset($competitor))
        <li><a href="#tab-features" data-toggle="tab">Features Comparison</a></li>
    @endif
</ul>

<div class="tab-content">
    <div class="tab-pane active" id="tab-general">
        @if (isset($competitor))
            {!! Form::model($competitor, array('url' => url('admin/competitor') . '/' . $competitor->id, 'method' => 'put', 'class' => 'bf', 'files'=> true)) !!}
        @else
            {!! Form::open(array('url' => url('admin/competitor'), 'method' => 'post', 'class' => 'bf', 'files'=> true)) !!}
        @endif

        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            {!! Form::label('name', trans("admin/competitors.name"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('name', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('name', ':message') }}</span>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-sm btn-success">
                <span class="glyphicon glyphicon-ok-circle"></span>
                {{ isset($competitor) ? trans("admin/modal.edit") : trans("admin/modal.create") }}
            </button>
        </div>
        {!! Form::close() !!}
    </div>

    @if(isset($competitor))
    <div class="tab-pane" id="tab-features">
        <div style="margin-top: 20px; margin-bottom: 20px; text-align: right;">
            <a href="#feature-form" class="btn btn-primary">
            <span class="glyphicon glyphicon-plus-sign"></span> Add New Feature
        </a>
        {{-- 1. Table of existing features (Now on Top) --}}
        <div class="table-responsive" style="margin-top: 20px;">
            <table class="table table-bordered table-striped" id="features-table">
                <thead>
                    <tr class="bg-info">
                        <th>Category</th>
                        <th>Feature Label</th>
                        <th>Our Value</th>
                        <th>Their Value</th>
                        <th style="width: 50px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    </tbody>
            </table>
        </div>

        <hr />

        {{-- 2. Form to Create New Feature (Now on Bottom) --}}
        <div class="well">
            <h4 style="margin-top: 0;">Add New Feature Comparison</h4>
            <form id="feature-form">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Category</label>
                            <select id="feat_category_id" class="form-control" required>
                                </select>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Feature Name (e.g. "API Access")</label>
                            <input type="text" id="feat_label" class="form-control" placeholder="What are we comparing?" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="color: #3c763d; background-color: #dff0d8;"><strong>Our Service</strong></div>
                            <div class="panel-body">
                                <textarea id="feat_our_value" class="form-control" placeholder="Describe our offering..." rows="2"></textarea>
                                <div class="checkbox">
                                    <label><input type="checkbox" id="feat_our_is_positive" checked> Is this a "Pro" for us?</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="color: #a94442; background-color: #f2dede;"><strong>Competitor</strong></div>
                            <div class="panel-body">
                                <textarea id="feat_their_value" class="form-control" placeholder="Describe their offering..." rows="2"></textarea>
                                <div class="checkbox">
                                    <label><input type="checkbox" id="feat_their_is_positive"> Is this a "Pro" for them?</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" id="btn-add-feature" class="btn btn-primary btn-block">
                    <span class="glyphicon glyphicon-plus-sign"></span> Add to Comparison Table
                </button>
            </form>
        </div>
    </div>
    @endif
</div>
@endsection

@section('scripts')
<script type="text/javascript">
$(document).ready(function() {
    @if(isset($competitor))
        var competitorId = "{{ $competitor->id }}";

        // Fetch categories for the dropdown
        function loadCategoryDropdown() {
            $.get("{{ url('admin/competitor') }}/" + competitorId + "/categories", function(data) {
                var items = '<option value="">-- Select Category --</option>';
                $.each(data, function(i, cat) {
                    items += '<option value="' + cat.id + '">' + cat.name + '</option>';
                });
                $('#feat_category_id').html(items);
            });
        }

        // Fetch and render the comparison table
        function loadFeatures() {
            $.get("{{ url('admin/competitor') }}/" + competitorId + "/features", function(data) {
                var rows = '';
                if(data.length === 0) {
                    rows = '<tr><td colspan="5" class="text-center text-muted">No features added yet.</td></tr>';
                } else {
                    $.each(data, function(i, feat) {
                        rows += '<tr id="feature-row-' + feat.id + '">' +
                            '<td><span class="label label-default">' + (feat.category ? feat.category.name : 'N/A') + '</span></td>' +
                            '<td><strong>' + feat.label + '</strong></td>' +
                            '<td class="' + (feat.our_is_positive ? 'text-success' : 'text-danger') + '">' + 
                                (feat.our_is_positive ? '<i class="glyphicon glyphicon-ok"></i> ' : '<i class="glyphicon glyphicon-remove"></i> ') + 
                                feat.our_value + '</td>' +
                            '<td class="' + (feat.their_is_positive ? 'text-success' : 'text-danger') + '">' + 
                                (feat.their_is_positive ? '<i class="glyphicon glyphicon-ok"></i> ' : '<i class="glyphicon glyphicon-remove"></i> ') + 
                                feat.their_value + '</td>' +
                            '<td><button class="btn btn-xs btn-danger delete-feature" data-id="' + feat.id + '"><i class="glyphicon glyphicon-trash"></i></button></td>' +
                        '</tr>';
                    });
                }
                $('#features-table tbody').html(rows);
            });
        }

        // Run on load
        loadCategoryDropdown();
        loadFeatures();

        // Add Feature Logic
        $('#btn-add-feature').click(function() {
            var btn = $(this);
            btn.prop('disabled', true).text('Saving...');

            var payload = {
                category_id: $('#feat_category_id').val(),
                label: $('#feat_label').val(),
                our_value: $('#feat_our_value').val(),
                our_is_positive: $('#feat_our_is_positive').is(':checked') ? 1 : 0,
                their_value: $('#feat_their_value').val(),
                their_is_positive: $('#feat_their_is_positive').is(':checked') ? 1 : 0,
                _token: "{{ csrf_token() }}"
            };

            $.post("{{ url('admin/competitor') }}/" + competitorId + "/features", payload, function(res) {
                loadFeatures(); // Refresh table
                $('#feature-form')[0].reset(); // Clear form
                btn.prop('disabled', false).html('<span class="glyphicon glyphicon-plus-sign"></span> Add to Comparison Table');
            }).fail(function(err) {
                alert('Validation error. Please check if Category and Label are set.');
                btn.prop('disabled', false).html('<span class="glyphicon glyphicon-plus-sign"></span> Add to Comparison Table');
            });
        });

        // Delete Feature Logic
        $(document).on('click', '.delete-feature', function() {
            var id = $(this).data('id');
            if(confirm('Are you sure you want to remove this feature?')) {
                $.ajax({
                    url: "{{ url('admin/competitor') }}/" + competitorId + "/features/" + id,
                    type: 'DELETE',
                    data: { _token: "{{ csrf_token() }}" },
                    success: function() {
                        $('#feature-row-' + id).fadeOut(300, function() { $(this).remove(); });
                    }
                });
            }
        });
    @endif
});
</script>
@endsection