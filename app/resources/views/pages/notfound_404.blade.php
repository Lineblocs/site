@extends('layouts.main')
@section('title') Home :: @parent @endsection
@section('content')
<div class="section no-bottom-margin more-padding" id="index-banner">
  <div class="container">
    <h1>Page Not Found</h1>
    <p>
      The page you requested could not be found.
    </p>
    <br/>
    <a onclick="javascript:window.history.back();">Go Back</a>
  </div>
</div>
@endsection
@section('scripts')
<script>
</script>
@endsection