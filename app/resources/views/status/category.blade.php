@extends('layouts.main_alt')
@section('title') Home :: @parent @endsection
@section('content')


    <section>
        <div class="container">
            <div class="service">
                <div class="serviceheading">
                    <h2>{{$category->name}}</h2>
                    <h5>Status {{$category->checkStatus()}}</h5>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <ul class="system-cats no-list-style">
                @if (count($updates)>0)
                    @foreach ($updates as $update)
                        <?php
                            $status = $category->checkStatus();
                        ?>
                        <li>
                            <div class="card horizontal">
                                    <div class="card-stacked">
                                        <div class="card-content">
                                            <div class="sys-status-name">
                                                <h2>
                                                <a href="/status/{{$category->id}}/{{$update->id}}"><div>{{$update->title}}</div></a>
                                                </h2>
                                                <small>Posted On {{$update->showCreatedFriendly()}}</small>
                                            </div>
                                            <div class="sys-status">
                                                <a href="/status/{{$category->id}}/{{$update->id}}" class="">View Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </li>
                        @endforeach
                </ul>
                @else
                <center><small>No updates available..</small></center>
                @endif


        </div>
    </section>

@endsection
@section('scripts')
<script>
</script>
@endsection

