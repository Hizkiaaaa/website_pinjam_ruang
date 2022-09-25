<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiPirang - {{$title}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ url('') }}/assets/css/main/app.css">
    <link rel="stylesheet" href="{{ url('') }}/assets/css/style.css">
    <link rel="shortcut icon" href="{{ url('') }}/assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="{{ url('') }}/assets/images/logo/favicon.png" type="image/png">
    <link rel="stylesheet" href="{{ url('') }}/assets/css/shared/iconly.css">

</head>

<body>
    @include('sweetalert::alert')
    <div id="app">
        <div id="main" class="layout-horizontal">
            @include('partial.header')
            <div class="content-wrapper container">
                @yield('heading')

                <div class="page-content">
                    <section class="row">
                        @yield('content')
                    </section>
                </div>

            </div>

            @include('partial.footer')
        </div>
    </div>
    <script src="{{ url('') }}/assets/js/bootstrap.js"></script>
    <script src="{{ url('') }}/assets/js/app.js"></script>
    <script src="{{ url('') }}/assets/js/style.js"></script>
    <script src="{{ url('') }}/assets/js/pages/horizontal-layout.js"></script>

    <script src="{{ url('') }}/assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="{{ url('') }}/assets/js/pages/dashboard.js"></script>

</body>

</html>