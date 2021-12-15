@extends('layouts.app_new', ['header_cls' => 'resources'])
@section('title') About :: @parent @endsection
@section('content')
  <!-- heading -->
  <section class="resources">
    <div class="container">
      <div class="resources">
        <!-- section hero -->
        <div class="row">
            <div class="col-12">
                <h1>Resources</h1>
                <p class="text-center">Everything you need to get the most out of your Lineblocs solution</p>
            </div>

        </div>

        <!-- section search -->
        <div class="row search">
            <div class="col-12" id="search-box">
                <form name="search_frm" method="GET" action="" novalidate id="search-form">
                    <input name="search" type="search" id="autocomplete-input" class="autocomplete" placeholder="Search Resources" required=""/>
                    <button type="submit" id="search" class="btn-custom service-btn resource-search">
                        <i class="material-icons"></i>
                        <span>Search</span>
                    </button>
                </form>
            </div>
        </div>

          <div class="row tiles">
              <div class="col-12 col-md-6 mb-4">
                  <div class="tile card card-block h-100">
                      <div class="row">
                          <div class="col-12 col-lg-6 title">
                              <div class="row">
                                  <div class="col-3 col-sm-2 col-md-12">
                                      <img src="/images/development.png" alt="Development icon" class="img-fluid icon" />
                                  </div>
                                  <div class="col-9 col-sm-10 col-md-12">
                                      <p>Quickstarts</p>
                                  </div>
                              </div>


                          </div>
                          <div class="col-12 col-lg-6 links">
                              <ul>
                                  <li>
                                      <a href="/resources/quickstarts/call-forward">Create a call forwarding</a>
                                  </li>
                                  <li>
                                      <a href="/resources/quickstarts/basic-ivr">Setup a basic 3 option IVR</a>
                                  </li>
                                  <li>
                                      <a href="/resources/quickstarts/recordings-and-voicemail">Add recordings/voicemail</a>
                                  </li>
                                  <li>
                                      <a href="/resources/quickstarts/call-queues">Setup Call Queues</a>
                                  </li>
                                  <li>
                                      <a class="view-all" href="/resources/quickstarts">View All</a>
                                  </li>
                              </ul>
                          </div>
                      </div>
                  </div>

              </div>
              <div class="col-12 col-md-6 mb-4">
                  <div class="tile card card-block h-100">
                      <div class="row">
                          <div class="col-12 col-lg-6 title">
                              <div class="row">
                                  <div class="col-3 col-sm-2 col-md-12">
                                      <img src="/images/icon-cell.png" alt="Development icon" class="img-fluid icon" />
                                  </div>
                                  <div class="col-9 col-sm-10 col-md-12">
                                      <p>Managing Numbers</p>
                                  </div>
                              </div>


                          </div>
                          <div class="col-12 col-lg-6 links">
                              <ul>
                                  <li>
                                      <a href="/resources/managing-numbers/purchase-numbers">Purchasing new numbers</a>
                                  </li>
                                  <li>
                                      <a href="/resources/managing-numbers/manage-numbers">Managing number tags and flows</a>
                                  </li>
                                  <li>
                                      <a href="/resources/managing-numbers/release-numbers">Releasing numbers</a>
                                  </li>
                                  <li>
                                      <a href="/resources/managing-numbers/porting-numbers">Porting Numbers</a>
                                  </li>
                                  <li>
                                      <a class="view-all" href="/resources/managing-numbers">View All</a>
                                  </li>

                              </ul>
                          </div>
                      </div>
                  </div>

              </div>
              <div class="col-12 col-md-6 mb-4">
                  <div class="tile card card-block h-100">
                      <div class="row">
                          <div class="col-12 col-lg-6 title">
                              <div class="row">
                                  <div class="col-3 col-sm-2 col-md-12">
                                      <img src="/images/icon-wallet.png" alt="Development icon" class="img-fluid icon" />
                                  </div>
                                  <div class="col-9 col-sm-10 col-md-12">
                                      <p>Billing & Pricing</p>
                                  </div>
                              </div>


                          </div>
                          <div class="col-12 col-lg-6 links">
                              <ul>
                                  <li>
                                      <a href="/resources/billing-and-pricing/call-pricing">Call pricing</a>
                                  </li>
                                  <li>
                                      <a href="/resources/billing-and-pricing/monthly-invoices">Monthly Invoices</a>
                                  </li>
                                  <li>
                                      <a href="/resources/billing-and-pricing/upgrading-plan">Upgrading Plan</a>
                                  </li>
                                  <li>
                                      <a href="/resources/billing-and-pricing/adding-credit">Adding Credit (Pay As You Go Only)</a>
                                  </li>
                                  <li>
                                      <a class="view-all" href="/resources/billing-and-pricing">View All</a>
                                  </li>
                              </ul>
                          </div>
                      </div>
                  </div>

              </div>
              <div class="col-12 col-md-6 mb-4">
                  <div class="tile card card-block h-100">
                      <div class="row">
                          <div class="col-12 col-lg-6 title">
                              <div class="row">
                                  <div class="col-3 col-sm-2 col-md-12">
                                      <img src="/images/docs-icon.png" alt="Development icon" class="img-fluid icon" />
                                  </div>
                                  <div class="col-9 col-sm-10 col-md-12">
                                      <p>Other Topics</p>
                                  </div>
                              </div>


                          </div>
                          <div class="col-12 col-lg-6 links">
                              <ul>

                                  <li>
                                      <a href="/resources/other-topics/learn-trial">Learn about trial balance</a>
                                  </li>
                                  <li>
                                      <a href="/resources/other-topics/account-settings">Account Settings</a>
                                  </li>
                                  <li>
                                      <a href="/resources/other-topics/usage-limits">Usage Limits (Pay-as-you-go only)</a>
                                  </li>
                                  <li>
                                      <a href="/resources/other-topics/setup-usage-triggers">Setup Usage Triggers</a>
                                  </li>
                                  <li>
                                      <a class="view-all" href="/resources/other-topics">View All</a>
                                  </li>
                              </ul>
                          </div>
                      </div>
                  </div>

              </div>
              <div class="col-12 col-md-6 mb-4">
                  <div class="tile card card-block h-100">
                      <div class="row">
                          <div class="col-12 col-lg-6 title">
                              <div class="row">
                                  <div class="col-3 col-sm-2 col-md-12">
                                      <img src="/images/settings-icon.png" alt="Development icon" class="img-fluid icon" />
                                  </div>
                                  <div class="col-9 col-sm-10 col-md-12">
                                      <p>Open Source</p>
                                      <p class="muted">How to install and setup the Lineblocs open source edition.</p>
                                  </div>
                              </div>


                          </div>
                          <div class="col-12 col-lg-6 links">
                              <ul>
                                  <li>
                                      <a href="/resources/open-source/install-centos8">Installing on CentOS 8</a>
                                  </li>
                                  <li>
                                      <a href="/resources/open-source/creating-trunks">Creating Trunks</a>
                                  </li>
                                  <li>
                                      <a href="/resources/open-source/working-with-routes">Working With Routes</a>
                                  </li>
                                  <li>
                                      <a href="/resources/open-source/setup-extension">Setup Extension</a>
                                  </li>
                                  <li>
                                      <a class="view-all" href="/resources/open-source">View All</a>
                                  </li>
                              </ul>
                          </div>
                      </div>
                  </div>

              </div>
          </div>



        </div>
    </div>
  </section>
@endsection
@section ('scripts')
<script>
    var acOptions = {!! json_encode($acOptions) !!};
    var clickedSearch = false;
    function validateForm() {
        var search = $("form[name='search_frm'] input[name='search']").val();
        if (search === "") {
            alert("Please enter a search term");
            return false;
        }
        return true;
    }
    $("form[name='search_frm']").submit(function(event) {
        if (!validateForm()) {
            event.preventDefault();
            event.stopPropagation();
            return;
        }
        if (clickedSearch) {
            return;
        }
        $("form[name='search_frm']").submit();
    });

    $("#search").click(function() {
        console.log("search clicked..");
        clickedSearch = true;
    });
    function clearHideLogic() {
         var val = $( "input[name='search']" ).val();
        if ( val === '' ) {
            $(".clear-search").hide();
        } else {
            $(".clear-search").show();
        }


    }
    $("input[name='search']").on("input",function() {
        clearHideLogic();
    })
    $(".clear-search").click(function() {
        $("input[name='search']").val("");
        clearHideLogic();
    });
  $(document).ready(function(){
  $('input.autocomplete').autocomplete({
    data: acOptions['options'],
    onAutocomplete: function() {
        console.log("auto completed ", this);
//clickedSearch = true;
        //$("form[name='search_frm']").submit();
        var value = this.el.value;
        var link = acOptions['links'][value];
        console.log("link is ", link);
        document.location.href = link;

    }
  });
  setTimeout(function() {
    patchMaterializeInputs();
  }, 0);
});
</script>
@endsection