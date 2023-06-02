<!-- JAVASCRIPT -->
<script src="{{ URL::asset('/assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/metismenu/metismenu.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/node-waves/node-waves.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/waypoints/waypoints.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/jquery-counterup/jquery-counterup.min.js') }}"></script>




<!-- App js -->
{{-- <script src="https://gist.github.com/jeremyyeo/7af35769124ced5049d9f5b93d8ad6da.js"></script> --}}
<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@yield('script')
@yield('script-bottom')
