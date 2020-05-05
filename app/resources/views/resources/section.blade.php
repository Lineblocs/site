@extends('layouts.main_alt')
@section('title') About :: @parent @endsection
@section('content')
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
        <div class="row">
            <div class="col s12">
    <a href="/resources/">Resources</a> > {{$sectionName}}
            </div>
        </div>
        <div class="row">
            <div class="col s12">
            <h1>{{$sectionName}}</h1>
            @foreach ($results as $result)
                <div class="card horizontal">
                    <div class="card-stacked">
                        <div class="card-content">
                            <h3>
                                <a href="/resources/{{$result['section']['link']}}/{{$result['item']['link']}}">{{$result['item']['name']}}</a>
                            </h3>
                            <p>{{$result['item']['description']}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    </div>
</div>
@endsection