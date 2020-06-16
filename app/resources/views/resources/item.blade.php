@extends('layouts.main_alt')
@section('title') About :: @parent @endsection
@section('content')
  <div class="section no-pad-bot" id="index-banner">
    <div class="container resource">
        <div class="row">
            <div class="col s12">
    <a href="/resources/">Resources</a> > <a href="/resources/{{$theSection['link']}}">{{$theSection['name']}}</a> > {{$title}}
            </div>
        </div>
        <div class="row"> 
            <div class="col s8">
                <div class="markdown">
                    {!! $html !!}
                </div>
            </div>
            <div class="col s4 related-bar">
                <div class="inner">
                    <h3>On This Page</h3>
                    <hr/>
                    <ul id="onThisPage" class="related-items">
                    </ul>
                    <h3>Related Items</h3>
                    <hr/>
                    <ul class="related-items">
                    @foreach ($related as $item)
                        <li>
                                <a href="/resources/{{$item['section']['link']}}/{{$item['item']['link']}}">{{$item['item']['name']}}</a>
                        </li>
                    @endforeach
                    </ul>
                <div class="card horizontal">
                    <div class="card-stacked">
                        <div class="card-content">
                            <h5>
                                Still need support ?
                            </h5>
                            <br/>
                            <p>We can help you with any questions you may have regarding this post.</p>
                            <br/>
                            <a class="btn-custom service-btn" href="/contact">Contact Us</a>
                        </div>
                    </div>
                </div>
                    </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    function slugify(text)
{
  return text.toString().toLowerCase()
    .replace(/\s+/g, '-')           // Replace spaces with -
    .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
    .replace(/\-\-+/g, '-')         // Replace multiple - with single -
    .replace(/^-+/, '')             // Trim - from start of text
    .replace(/-+$/, '');            // Trim - from end of text
}
function gotoSection(slug, animate) {
    if ( typeof animate !== 'undefined' && !animate ) {
        animate = false;
    } else {
        animate = true;
    }
    var pos = $( "#" + slug ).offset().top;

    if ( animate ) {
        $('html, body').animate({
                scrollTop: pos
                }, 1000);
                return;
            }
            window.scrollTo(0,pos);
}
window.addEventListener("load", function() {
        $(".markdown a").each(function() {
            $( this ).attr("target", "_blank");
        });
        $("h2").each(function() {
            var text = $( this ).text();
            var slug = slugify( text );
            if ( slug === 'next-steps' ) { // dont include
                return;
            }
            var li = $("<li></li>");
            var a = $("<a></a>");
            a.text( text );
            a.appendTo( li );
            li.appendTo($("#onThisPage"));
            $( this ).attr("id", slug);
            a.attr("href", "#"+slug);
            a.click(function(event) {
                event.preventDefault();
                event.stopPropagation();
                gotoSection( slug );
                document.location.hash = "#" + slug;
            });
        });
        var hash = window.location.hash;
        if ( hash !== '' ) {
            setTimeout(function() {
                gotoSection(hash.split("#")[1], false);
            }, 0);
        }
    });
</script>

@endsection