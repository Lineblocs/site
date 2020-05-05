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
            <div class="col s9">
                <div class="markdown">
                    {!! $html !!}
                </div>
            </div>
            <div class="col s3 related-bar">
                <div class="inner">
                    <h3>Related Items</h3>
                    <hr/>
                    <ul>
                    @foreach ($related as $item)
                        <li>
                                <a href="/resources/{{$item['section']['link']}}/{{$item['item']['link']}}">{{$item['item']['name']}}</a>
                        </li>
                    @endforeach
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