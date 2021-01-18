@extends('layouts.app_new')
@section('title') Home :: @parent @endsection
@section('content')

    <!-- main -->
    <main class="trunking-networks-detail container">
      <!-- back button -->
      <a
        class="trunking-networks-detail__back-btn"
        href="javascript:history.back()"
      >
        <svg
          width="106"
          height="49"
          viewBox="0 0 106 49"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M19.1843 1.75397C19.8493 0.959213 20.8323 0.5 21.8686 0.5H102C103.933 0.5 105.5 2.067 105.5 4V45C105.5 46.933 103.933 48.5 102 48.5H21.8686C20.8323 48.5 19.8493 48.0408 19.1843 47.246L2.03128 26.746C0.943647 25.4462 0.943647 23.5538 2.03127 22.254L19.1843 1.75397Z"
            stroke="#D7D8E1"
          />
        </svg>
        <span>Back</span>
      </a>

      <header>
        <h1>{{$category->name}}</h1>
        <p class="trunking-networks-detail__date"></p>
      </header>

      <section class="trunking-networks-detail__content">
        <h4 class="trunking-networks-detail__title"></h4>
        <p class="trunking-networks-detail__description"></p>
      </section>
      <section>
        <div class="trunking-networks-detail__nav">
          <!-- top navigation -->
          <div class="trunking-networks-detail__nav-links">
            <a href="#">0 Comments</a>
            <a href="#">Lineblocs</a>
            <a href="#">
              <i class="tiny material-icons">lock</i>
              Discus' Privacy Policy</a
            >
          </div>
          <div class="trunking-link">
            <!-- Dropdown Trigger -->
            <a class="dropdown-trigger" href="#!" data-target="dropdown1"
              >Login<i class="material-icons right">arrow_drop_down</i></a
            >
            <!-- Dropdown Structure -->
            <ul id="dropdown1" class="dropdown-content">
              <li><a href="#!">one</a></li>
              <li><a href="#!">two</a></li>
              <li class="divider"></li>
              <li><a href="#!">three</a></li>
            </ul>
          </div>
        </div>

        <div class="disqus">
          <br />
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
            (function () {
              // DON'T EDIT BELOW THIS LINE
              var d = document,
                s = d.createElement("script");
              s.src = "https://lineblocs.disqus.com/embed.js";
              s.setAttribute("data-timestamp", +new Date());
              (d.head || d.body).appendChild(s);
            })();
          </script>
          <noscript
            >Please enable JavaScript to view the
            <a href="https://disqus.com/?ref_noscript"
              >comments powered by Disqus.</a
            ></noscript
          >
        </div>
      </section>
    </main>

@endsection
@section('scripts')
<script>
const update = {!! json_encode($update) !!};
const trunkingNetworkDetail = {
  title: update.title,
  description: update.body,
  status: update.status,
  date: update.date_friendly
}
</script>
    <script src="/js/components/TrunkingNetworkDeail.js"></script>
<script>
</script>
@endsection