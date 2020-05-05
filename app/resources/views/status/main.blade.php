@extends('layouts.main_alt')
@section('title') Home :: @parent @endsection
@section('content')


    <section>
        <div class="container">
            <div class="service">
                <h2 class="serviceheading">System Status</h2>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <ul class="system-cats no-list-style">
                @foreach ($categories as $category)
                    <?php
                        $status = $category->checkStatus();
                    ?>
                    <li>
                        <div class="card horizontal">
                                <div class="card-stacked">
                                    <div class="card-content">
                                        <h2 class="sys-status-name">
                                            <a href="/status/{{$category->id}}"><div class="name">{{$category->name}}</div></a>
                                        </h2>
                                        <div class="sys-status">
                                            @if ($status == 'UP')
                                                <h5>UP</h5>
                                            @elseif ($status =='DOWN')
                                                <h5>DOWN</h5>
                                            @elseif ($status =='IN-MAINTENANCE')
                                                <h5>In Maintenance</h5>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </li>
                    @endforeach
                </ul>


        </div>
    </section>

@endsection
@section('scripts')
<script>
</script>
@endsection

