@extends('layouts.app_new')
@section('title') Home :: @parent @endsection
@section('content')
  <!-- top hero section -->
  <main class="system-status container">
    <header>
      <h1>System Status</h1>
      <p>As of {{$date}}</p>
    </header>
    <section class="system-status__container">
    </section>
    <section class="system-status__states">
      <p>
        <span class="system-status__point"></span>
        100% uptime
      </p>
      <p>
        <span class="system-status__point system-status--maintenance"></span>
        Partial degradation
      </p>
      <p>
        <span class="system-status__point system-status--downtime"></span>
        Downtime
      </p>
    </section>
  </main>

@endsection
@section('scripts')
  <script>

    var categories = {!! json_encode($categories) !!};
    var statusData = [];
    categories.forEach(function(category) {

        statusData.push({
            "id": category.id,
            "title": category.name,
            "description": category.current_status,
            "partial_degradation": category.partial_degradation,
            "downtime": category.downtime
        });
    });
  </script>
  <script src="/js/components/Status.js"></script>
@endsection

