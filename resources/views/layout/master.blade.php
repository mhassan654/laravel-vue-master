<!DOCTYPE HTML>
<html lang="zxx">
@include('partials.header')

<body>
    <!-- HEADER -->
    @include('partials.nav')
    <!-- HEADER -->
    <!-- BANNER -->

    <!-- BANNER -->

    <!-- BODY -->
    @yield('content')
    <!-- BODY -->



    <!-- FOOTER -->
    @include('partials.footer')
    <!-- FOOTER -->




</body>
<script src="assets/js/jquery-1.12.4.min.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/main.js"></script>
<script src="{{mix('js/app.js')}}"></script>

</html>
