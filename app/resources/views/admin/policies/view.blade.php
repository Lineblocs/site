@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title') {!! trans("admin/policies.policies") !!} :: @parent
@endsection

{{-- Content --}}
@section('main')
    <div class="page-header">
        <h3>
            {!! trans("admin/policies.policies") !!}
        </h3>
    </div>
    <div class="col-md-12">
        <form method="POST" action="">
            <div class="row form-group">
                <label for="privacy_policy">Privacy Policy</label>
                <textarea class="form-control" name="privacy_policy">{!! $policies['privacy_policy'] !!}</textarea>
            </div>
            <div class="row form-group">
                <label for="terms_of_service">Terms of Service</label>
                <textarea class="form-control" name="terms_of_service">{!! $policies['terms_of_service'] !!}</textarea>
            </div>
            <div class="row form-group">
                <label for="service_level_agreement">Service Level Agreement</label>
                <textarea class="form-control" name="service_level_agreement">{!! $policies['service_level_agreement'] !!}</textarea>
            </div>

            <div class="row form-group">
                <div class="clearfix">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </div>
        </form>
</div>
@endsection

{{-- Scripts --}}
@section('scripts')
<script>
$(document).ready(function() {
    var existingFaqs = {!! json_encode( $policies ) !!};
    var addBtn = $("#addFAQ");
    var policies = $("#policies");

    function addField(key, count, placeholder, type) {
        type = type || 'text'
        var input = $("<input class='form-control'/>")
        var name = "policies[" + count + "][" + key + "]";
        input.attr("name", name);
        input.attr("placeholder", placeholder);
        input.attr("type", type);
        return input;
    }
    function addFieldTextarea(key, count, placeholder) {
        var input = $("<textarea class='form-control'/>")
        var name = "policies[" + count + "][" + key + "]";
        input.attr("name", name);
        input.attr("placeholder", placeholder);
        return input;
    }

    function addFAQItem( data ) {
        var faq_length = policies.find("li.item").length;
        var item = $("<li class='item no-list-style'></li>")
        var question = addField("question", faq_length, "Question");
        if ( data && data['question'] ) {
            question.val( data['question'] );
        }
        var answer = addFieldTextarea("answer", faq_length, "Answer");
        if ( data && data['answer'] ) {
            answer.val( data['answer'] );
        }
        if ( data ) {
            var id_field = addField('id', faq_length, "", 'hidden');
            id_field.val( data['id'] );
            id_field.appendTo( item );
        }
        question.appendTo( item );
        answer.appendTo( item );

        var remove = $("<a href='#'>(delete)</a>");
        remove.click( function() {
            item.remove().end();
        });
        remove.appendTo( item );
        policies.append( item );
    }
    addBtn.click(function() {
        addFAQItem();
    });
    existingFaqs.forEach(function( item ) {
        addFAQItem( item );
    });
});
</script>
@endsection