@extends('layouts.main_alt')
@section('title') About :: @parent @endsection
@section('content')
  <section class="resources">
    <div class="container">
        <div class="resources">
            <div class="row">
                @if ($searched)
                    @if (!count($results)>0)
                        <center>
                            <h2>No results found</h2>
                            <a href="/resources/">&lt;&lt; Back to resources</a>
                        </center>
                    @else
                        <a href="/resources/">&lt;&lt; Back to resources</a>
                        <h2>Search results for "{{$search}}"</h2>
                        @foreach ($results as $result)
                            <div class="card horizontal-rounded">
                                <div class="card-stacked">
                                    <div class="card-content">
                                        <h2>
                                            <a href="/resources/{{$result['section']['link']}}/{{$result['item']['link']}}">{{$result['item']['name']}}</a>
                                        </h2>
                                        <p>{{$result['item']['description']}}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                @else
                    <form name="search_frm" method="GET" action="" novalidate>
                        <div class="relative">
                        <div class="input-field col s12 l10">
                            <i class="material-icons prefix">search</i>
                            <!--<input name="search" id="icon_prefix" type="text" class="validate autocomplete" required="">-->
                                      <input name="search" type="search" id="autocomplete-input" class="autocomplete" />
                            <label for="autocomplete-input">Search Resources</label>
                            <a href="#" class="clear-search">X</a>
                        </div>
                    </div>
                        <div class="col s12 l2">
                            <div id="search" class="btn-custom service-btn resource-search"><span>Search</span></div>
                        </div>
                    </form>
                    <div class="resource-sections">
                    @foreach ($data['sections'] as $section)
                        <div class="col {{$section['size']}}">
                            <h2 class="resource-hdg">{{$section['name']}}</h2>
                            @if (!empty($section['show_desc']))
                                <p>{{$section['description']}}</p>
                            @endif
                            <ul>
                            @foreach ($section['items'] as $item)
                                <li>
                                    <a href="/resources/{{$section['link']}}/{{$item['link']}}">{{$item['name']}}</a>
                                </li>
                            @endforeach
                            </ul>
                            <a href="/resources/{{$section['link']}}">View All</a>
                        </div>
                    @endforeach
                    </div>
                @endif
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
        if (!validateForm()) {
            return;
        }
        clickedSearch = true;
        $("form[name='search_frm']").submit();
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