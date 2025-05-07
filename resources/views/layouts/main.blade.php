<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="{{ $siteSettings->author ?? 'Personal Web' }}" />
    <meta name="description" content="{{ $siteSettings->description ?? 'Personal Portfolio Website' }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta_Share')

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/image/favicon.ico') }}" type="image/x-icon" />
    <link rel="icon" href="{{ asset('assets/image/favicon.ico') }}" type="image/x-icon" />

    <!-- Icons -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pe-icon-7-stroke.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pe-helper.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-icons.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/all.min.css') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/" />
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&amp;family=Poppins:wght@700;900&amp;display=swap"
        rel="stylesheet" />

    <!-- CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/leaflet.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/aos.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ route('dynamic.css') }}">
    <title>@yield('title', $siteSettings->site_name ?? 'Personal Web')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />

</head>

<body data-bs-spy="scroll" data-bs-target="#site-navbar" class="home-vcard">
    <!-- PRE LOADER -->
    <div class="preloader js-preloader flex-center">
        <div class="dots">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>
    </div>

    <!-- SITE HEADER -->
    @include('partials.header')
    <!-- .site-header -->

    <div class="container">
        <div class="box-wrapper">
            @yield('content')
            <!-- SITE FOOTER -->
            @include('partials.footer')
            <!-- .site-footer -->
        </div>
        <!-- .box-wrapper -->
    </div>
    <!-- .container -->
    <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/leaflet.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/js/aos.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.preloadinator.min.js') }}"></script>
    <script src="{{ asset('assets/js/vanilla-tilt.min.js') }}"></script>
    <script src="{{ asset('assets/js/typer.js') }}"></script>
    <script src="{{ asset('assets/js/magicmouse.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
</body>

</html>
