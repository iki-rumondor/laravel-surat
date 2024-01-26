<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="{{ url('/assets/css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ url('/assets/font-awesome/css/all.css') }}" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato|Roboto+Slab" />

    @yield('css')
    <style>
        body {
            background-color: #eee;
            font-family: 'Lato', sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Roboto Slab', serif;
        }

        .container {
            margin-top: 20px;
        }

        .bg-light {
            background-color: #fff !important;
        }
    </style>
    <title>@yield('title')</title>
</head>

<body>
    <!-- include navbar -->
    @include('layouts.components.navbar')

    <!-- content -->
    @yield('content')

    <script type="text/javascript" src="{{ url('/assets/js/jquery-3.3.1.js') }}"></script>
    <script type="text/javascript" src="{{ url('/assets/js/bootstrap.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                paging: false,
                info: false,
                ordering: false
            });
        });
    </script>
    <!-- custom different javascript in every module -->
    @yield('js')
</body>

</html>
