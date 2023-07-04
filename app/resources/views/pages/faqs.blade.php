@extends('layouts.app_new')
@section('title')
FAQs
@endsection
@section('metaDescription')
faqs, how to use site, documentation
@endsection
@section('content')
  <div class="container faq">
    <div class="row heading">
      <div class="col-12">
        <h1 class="text-center">FAQs</h1>
        <p class="text-center"></p>
      </div>
    </div>
    <div class="row list-faqs" >

      <div class="accordion" id="accordion">
        @foreach ( $faqs as $cnt => $faq )
          @if ($cnt == 0)
            <div class="card">
                <div class="card-header" id="heading1">
                  <h2 class="mb-0">
                    <button class="btn btn-link pl-0" type="button" data-toggle="collapse" data-target="#collapse{{$cnt}}" aria-expanded="true" aria-controls="collapse{{$cnt}}">
                      {{$faq->question}}
                    </button>
                  </h2>
                </div>

              <div id="collapse{{$cnt}}" class="collapse show" aria-labelledby="heading{{$cnt}}" data-parent="#accordion">
                <div class="card-body">
                  {{$faq->answer}}
                </div>
              </div>
            </div>
          @else
        <div class="card">
          <div class="card-header" id="heading2">
            <h2 class="mb-0">
              <button class="btn btn-link collapsed pl-0" type="button" data-toggle="collapse" data-target="#collapse{{$cnt}}" aria-expanded="false" aria-controls="collapse{{$cnt}}">
                {{$faq->question}}
              </button>
            </h2>
          </div>
          <div id="collapse{{$cnt}}" class="collapse" aria-labelledby="heading{{$cnt}}" data-parent="#accordion">
            <div class="card-body">
                {{$faq->answer}}
            </div>
          </div>
        </div>
          @endif
          @endforeach
        
    <p>
      For more topics and support please view our <a href="{{\App\Helpers\MainHelper::createUrl('/resources')}}">Resources</a> section
    </p>
  </div>
</div>
</div>
@endsection
@section('scripts')
<script>
</script>
@endsection