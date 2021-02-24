@extends('layouts.app_new')
@section('title') Home :: @parent @endsection
@section('content')
<section class="notfound">
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-6">
        <h1 class="text-left">Ooops, something went wrong...</h1>
        <p>We can't seem to find the page you're looking for.</p>
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