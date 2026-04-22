@extends('layouts.app_new')
@section('title') Home :: @parent @endsection
@section('content')
<section class="notfound">
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-6">
        <h1 class="text-left">Internal Error</h1>
        <p>Something went wrong. Please try again. 
          <br/>
          <small>If the issue persists please reach out to us at <a href="/contact">contact us</a></small>
        </p>
        <a href="/" class="button btn primary-button bg-blue">Go home</a>
        <div class="extra-links">
          <p>Here are some helpful links instead:</p>
          <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/resources">Search</a></li>
            <li><a href="/resources">Help</a></li>
          </ul>
        </div>
      </div>
      <div class="col-12 col-md-6">
        <img src="/images/404.png" alt="404 image" class="img-fluid">
      </div>
    </div>
  </div>
</section>

@endsection
@section('scripts')
<script>
</script>
@endsection