@extends('admin.layouts.modal')
{{-- Content --}}
@section('content')

    <h2>{{$systemstatus->name}}</h2>
    <a class="btn btn-success" href="/admin/systemstatus/{{$systemstatus->id}}/add_alert">Add Alerts</a>
    <h5>List of updates</h5>
    <table class="table stripped">
        <thead>
            <th>Title</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Updated At</th>
        </thead>
        <tbody>
            @foreach ($updates as $update)
                <tr>
                    <td>{{$update->title}}</td>
                    <td>{{$update->status}}</td>
                    <td>{{$update->created_at}}</td>
                    <td>{{$update->updated_at}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    {!! Form::close() !!}
    @endsection @section('scripts')
        <script type="text/javascript">
            $(function () {
                $("#roles").select2()
            });
        </script>
</div>
@endsection
