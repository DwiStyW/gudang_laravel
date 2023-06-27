@yield('css')
<!-- Bootstrap Css -->
<link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{ URL::asset('/assets/css/icons.min.css') }}" id="icons-style" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{ URL::asset('/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
<!-- Global Css-->
<link rel="stylesheet" href="{{ asset('/assets/css/global.css') }}">

<link rel="stylesheet" href="{{ asset('assets/libs/codemirror/lib/codemirror.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/codemirror/theme/dracula.css') }}">

<script src="../assets/js/code/highcharts.js"></script>
<script src="../assets/js/code/modules/drilldown.js"></script>
<script src="../assets/js/code/modules/stock.js"></script>
<script src="../assets/js/code/modules/exporting.js"></script>
<script src="../assets/js/code/modules/export-data.js"></script>
<script src="../assets/js/code/modules/accessibility.js"></script>
