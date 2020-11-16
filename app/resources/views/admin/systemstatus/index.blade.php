@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title') {!! trans("admin/systemstatuses.system_status") !!} :: @parent
@endsection

{{-- Content --}}
@section('main')

  <!-- top hero section -->
  <main class="system-status container">
    <header>
      <h1>System Status</h1>
      <p>As of 13 Otober 2020 18:12</p>
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

{{-- Scripts --}}
@section('scripts')
  <script>
    var statusData = [
      {
        title: 'SIP Trunking Networks',
        description: '100% uptime',
        status: 'uptime',
        partial_degradation: [61,62,63],
        downtime: null
      },
      {
        title: 'Media Storage Servers',
        description: 'In Mainenance',
        status: 'maintenance',
        partial_degradation: [70, 91,92,93],
        downtime: [51,52,53] 
      },
      {
        title: 'PoP Servers',
        description: '100% uptime',
        status: 'uptime',
        partial_degradation: [51,52,53,54,55,56,57,91,92,93],
        downtime: null
      },
      {
        title: 'User Portals',
        description: 'Downtime',
        status: 'downtime',
        partial_degradation: [51,91,92,93],
        downtime: null
      },
    ];
  </script>
  <script src="./js/components/Status.js"></script>
@endsection
