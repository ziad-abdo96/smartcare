<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
    <meta name="Keywords"
        content="admin,admin dashboard,admin dashboard template,admin panel template,admin template,admin theme,bootstrap 4 admin template,bootstrap 4 dashboard,bootstrap admin,bootstrap admin dashboard,bootstrap admin panel,bootstrap admin template,bootstrap admin theme,bootstrap dashboard,bootstrap form template,bootstrap panel,bootstrap ui kit,dashboard bootstrap 4,dashboard design,dashboard html,dashboard template,dashboard ui kit,envato templates,flat ui,html,html and css templates,html dashboard template,html5,jquery html,premium,premium quality,sidebar bootstrap 4,template admin bootstrap 4" />
    <!--  Owl-carousel css-->
    <link href="{{ URL::asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet" />
    <!-- Maps css -->
    <link href="{{ URL::asset('assets/plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet">
    @include('layouts.head')
</head>

<body class="main-body app sidebar-mini">
    <!-- Loader -->
    <div id="global-loader">
        <img src="{{asset('assets/img/loader.svg') }}" class="loader-img" alt="Loader">
    </div>
    <!-- /Loader -->
    @include('layouts.main-sidebar')
    <!-- main-content -->
    <div class="main-content app-content">
        @include('layouts.main-header')
        <!-- container -->
        <div class="container-fluid">
            @yield('page-header')
            @yield('content')
            @include('layouts.sidebar')
            @include('layouts.models')
            @include('layouts.footer')
            @include('layouts.footer-scripts')
            <script>
                <!--Internal  Chart.bundle js 
                -->
            <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
            <!-- Moment js -->
            <script src="{{ URL::asset('assets/plugins/raphael/raphael.min.js') }}"></script>
            <!--Internal  Flot js-->
            <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
            <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js') }}"></script>
            <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
            <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js') }}"></script>
            <script src="{{ URL::asset('assets/js/dashboard.sampledata.js') }}"></script>
            <script src="{{ URL::asset('assets/js/chart.flot.sampledata.js') }}"></script>
            <!--Internal Apexchart js-->
            <script src="{{ URL::asset('assets/js/apexcharts.js') }}"></script>
            <!-- Internal Map -->
            <script src="{{ URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
            <script src="{{ URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
            <script src="{{ URL::asset('assets/js/modal-popup.js') }}"></script>
            <!--Internal  index js -->
            <script src="{{ URL::asset('assets/js/index.js') }}"></script>
            <script src="{{ URL::asset('assets/js/jquery.vmap.sampledata.js') }}"></script>
            </script>
</body>

</html>
