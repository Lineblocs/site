<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @section('title') Administration @show
    </title>
    @section('meta_keywords')
        <meta name="keywords" content="your, awesome, keywords, here" />
        @show @section('meta_author')
        <meta name="author" content="Jon Doe" />
        @show @section('meta_description')
        <meta name="description"
            content="Lorem ipsum dolor sit amet, nihil fabulas et sea, nam posse menandri scripserit no, mei." />
    @show
    <link rel="shortcut icon" href="{!! asset('images/new-icon.png') !!}">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom-backend.css') }}" rel="stylesheet">
    <script src="{{ asset('js/admin.js') }}"></script>

    <link rel="shortcut icon" href="{!! asset('images/new-icon.png') !!}">
    @yield('styles')
</head>

<body>
    <div id="wrapper">
        @include('admin.partials.nav')
        <div id="page-wrapper">
            @if (Session::has('message'))
                <p class="alert alert-{{ Session::get('type', 'info') }}">{{ Session::get('message') }}</p>
            @endif
            @yield('main')
        </div>
    </div>

    <script type="text/javascript">
        @if (isset($type))

            var oTable;
            var params = {!! json_encode(request()->all()) !!};

            $(document).ready(function() {
                oTable = $('#table').DataTable({
                    "pageLength": 20,
                    "ordering": false,
                    "oLanguage": {
                        "sProcessing": "{{ trans('table.processing') }}",
                        "sLengthMenu": "{{ trans('table.showmenu') }}",
                        "sZeroRecords": "{{ trans('table.noresult') }}",
                        "sInfo": "{{ trans('table.show') }}",
                        "sEmptyTable": "{{ trans('table.emptytable') }}",
                        "sInfoEmpty": "{{ trans('table.view') }}",
                        "sInfoFiltered": "{{ trans('table.filter') }}",
                        "sInfoPostFix": "",
                        "sSearch": "{{ trans('table.search') }}:",
                        "sUrl": "",
                        "oPaginate": {
                            "sFirst": "{{ trans('table.start') }}",
                            "sPrevious": "{{ trans('table.prev') }}",
                            "sNext": "{{ trans('table.next') }}",
                            "sLast": "{{ trans('table.last') }}"
                        }
                    },
                    "processing": false,
                    "serverSide": true,
                    "order": [],
                    "ajax": {
                        "url": "{{ url('admin/' . $type . '/data') }}",
                        'contentType': 'application/json',
                        "data": function(data) {

                        },
                        success: function(response) {

                            var html = '';
                            $.each(response.data, function(k, v) {
                                html += '<tr>';
                                $.each(v, function(l, m) {
                                    //console.log(m);
                                    var $this = $(this);
                                    html += '<td>' + decode(m) + '</td>';
                                });
                                html += '</tr>';
                            });

                            $("#table").find('tbody').html(html);

                            $(".iframe").colorbox({
                                iframe: true,
                                width: "80%",
                                height: "80%",
                                onClosed: function() {
                                    oTable.ajax.reload();
                                }
                            });

                        },
                    },
                    "pagingType": "full_numbers",
                    "fnDrawCallback": function(oSettings) {
                        console.log('testtt');
                        $(".iframe").colorbox({
                            iframe: true,
                            width: "80%",
                            height: "80%",
                            onClosed: function() {
                                oTable.ajax.reload();
                            }
                        });
                    }
                });
            });

            function decode(str) {
                let txt = new DOMParser().parseFromString(str, "text/html");
                return txt.documentElement.textContent;
            }
        @endif
    </script>

    @yield('scripts')
</body>

</html>
