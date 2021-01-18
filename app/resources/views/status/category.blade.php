@extends('layouts.app_new')
@section('title') Home :: @parent @endsection
@section('content')

  <!-- main -->
  <main class="trunking-networks container">
    <a class="trunking-networks__back-btn" href="javascript:history.back()">
      <svg width="106" height="49" viewBox="0 0 106 49" fill="none"
           xmlns="http://www.w3.org/2000/svg">
        <path d="M19.1843 1.75397C19.8493 0.959213 20.8323 0.5 21.8686 0.5H102C103.933 0.5 105.5 2.067 105.5 4V45C105.5 46.933 103.933 48.5 102 48.5H21.8686C20.8323 48.5 19.8493 48.0408 19.1843 47.246L2.03128 26.746C0.943647 25.4462 0.943647 23.5538 2.03127 22.254L19.1843 1.75397Z"
              stroke="#D7D8E1" />
      </svg>
      <span>Back</span>
    </a>

    <header>
      <h1>{{$category->name}}</h1>
      <p> <span class="system-status__point"></span> 100% uptime</p>
    </header>
    <section class="trunking-networks__content">

    </section>
    <!--
    <button class="trunking-networks__see-all-btn">
      <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M8.32604 0.664062C3.72961 0.664062 0 4.40354 0 8.99996C0 13.5964 3.71122 17.3358 8.35548 17.3358V14.5493C5.29027 14.5493 2.78656 12.0598 2.78656 8.99996C2.78656 5.94003 5.25627 3.45062 8.3162 3.45062C11.3138 3.45062 13.7622 5.84008 13.8608 8.81416H12.4877L15.2439 12.6856L18 8.81416H16.6497C16.5508 4.30322 12.8604 0.664062 8.32604 0.664062Z"
              fill="#6AD7FA" />
      </svg>
      See all results
    </button>
-->
  </main>
@endsection
@section('scripts')
<script>
const trunkingNetworks = {!! json_encode($updates) !!};
/*
[
  {
    id: 10,
    date: '10 October 2020',
    description: '100% uptime',
    status: 'uptime'
  },
  {
    id: 09,
    date: '09 October 2020',
    description: 'In Maintenance',
    status: 'maintenance'
  },
  {
    id: 08,
    date: '08 October 2020',
    description: 'In Maintenance',
    status: 'maintenance'
  },
  {
    id: 07,
    date: '07 October 2020',
    description: 'Downtime',
    status: 'downtime'
  },
  {
    id: 06,
    date: '06 October 2020',
    description: '100% uptime',
    status: 'uptime'
  },
  {
    id: 05,
    date: '05 October 2020',
    description: 'In Maintenance',
    status: 'maintenance'
  },
  {
    id: 04,
    date: '04 October 2020',
    description: 'In Maintenance',
    status: 'maintenance'
  },
  {
    id: 03,
    date: '03 October 2020',
    description: 'Downtime',
    status: 'downtime'
  },
  {
    id: 02,
    date: '02 October 2020',
    description: '100% uptime',
    status: 'uptime'
  },
  {
    id: 01,
    date: '01 October 2020',
    description: 'In Maintenance',
    status: 'maintenance'
  },
];
*/

// use last one

if ( trunkingNetworks.length ) {
    var last = trunkingNetworks[ trunkingNetworks.length - 1 ];
    const trunkingNetworkDetail = {
        title: last.title,
        description: last.description,
        status: last.status,
        date: last.date
    };

    /*
    const trunkingNetworkDetail = {
    title: 'Infrastructure Down',
    description: 'Investigating - We are experiencing delivery failures sending to Kyrgyzstan Sky Mobile. Our engineers are working with our carrier partner to resolve the issue. We expect to provide another update in 1 hour or as soon as more information becomes available.',
    status: 'maintenance',
    date: '08 October 2020',
    }
    */
}
var category = {!! json_encode($category) !!};
</script>

  <script src="/js/components/TrunkingNetwork.js"></script
<script>
</script>
@endsection

