@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title') {!! trans("admin/callrates.call_rates") !!} :: @parent
@endsection

{{-- Content --}}
@section('main')
    <div class="page-header">
        <h3>
            {!! trans("admin/faqs.faqs") !!}
        </h3>
    </div>
    <div class="col-md-12">
        <form method="POST" action="">
            <div class="row form-group">
                <ul class="no-list-style clearfix" id="faqs">

                </ul>
                <button id="addFAQ" type="button" class="btn btn-info btn-sm">Add item</button>
                <hr/>
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
    var existingFaqs = {!! json_encode( $faqs ) !!};
    var addBtn = $("#addFAQ");
    var faqs = $("#faqs");

    function addField(key, count, placeholder, type) {
        type = type || 'text'
        var input = $("<input class='form-control'/>")
        var name = "faqs[" + count + "][" + key + "]";
        input.attr("name", name);
        input.attr("placeholder", placeholder);
        input.attr("type", type);
        return input;
    }
    function addFAQItem( data ) {
        var faq_length = faqs.find("li.item").length;
        var item = $("<li class='item no-list-style'></li>")
        var question = addField("question", faq_length, "Question");
        if ( data && data['question'] ) {
            question.val( data['question'] );
        }
        var answer = addField("answer", faq_length, "Answer");
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
        faqs.append( item );
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