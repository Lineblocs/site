@extends('layouts.main_alt')
@section('title') Home :: @parent @endsection
@section('content')


    <section>
        <div class="container">
            <div class="service">
                <div class="serviceheading">
                    <h2>{{$update->title}}</h2>
                    <h5>{{$update->showCreatedFriendly()}}</h5>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="body">
            {!! $update->body !!}
            <br/>
            </div>
            <hr/>
            <div class="disqus">
                <br/>
                <div id="disqus_thread"></div>
<script>

/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
/*
var disqus_config = function () {
this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
*/
(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = 'https://lineblocs.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                            
            </div>
        </div>

    </section>

@endsection
@section('scripts')
<script>
</script>
@endsection

