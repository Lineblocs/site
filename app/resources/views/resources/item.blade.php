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
                    <h3>Related Items</h3>
                    <hr/>
                    <ul class="related-items">
                    @foreach ($related as $item)
                        <li>
                                <a href="/resources/{{$item['section']['link']}}/{{$item['item']['link']}}">{{$item['item']['name']}}</a>
                        </li>
                    @endforeach
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
    $(document).ready(function() {
        $(".markdown a").each(function() {
            $( this ).attr("target", "_blank");
        });
    });
</script>

@endsection