@extends('layouts.app_new')
@section('title') About :: @parent @endsection
@section('content')
  <div class="resources-section section no-pad-bot" id="index-banner">
    <div class="container">
        <div class="row breadcrumbs">
            <div class="col s12">
    <a href="/resources">Resources</a> <span>Search results</span>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
            <h1 class="text-left">Results for "{{$query}}"</h1>

                @if ( count( $results ) >  0)
                    <div class="cards">
                        @foreach ($results as $result)
                            <a href="/resources/{{$result['section']['link']}}/{{$result['item']['link']}}" class="card h-100 justify-content-center">
                                <div class="content">
                                    {{$result['item']['name']}}
                                    <p>{{$result['item']['description']}}</p>
                                </div>
                                <span class="arrow"></span>
                            </a>

                        @endforeach
                    </div>
                @else
                    <div class="no-results">
                     <h5>No results found..</h5>
                </div>
                @endif

        </div>
    </div>
    </div>
</div>
@endsection