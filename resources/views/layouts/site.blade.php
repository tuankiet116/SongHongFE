<!DOCTYPE html>
<html lang="en">

<head>
    <title>{!! $title !!}</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="title" content="{!! $title !!}">
    <meta name="description" content="{{ $description }}">
    <meta name="keywords" content="{{ $config->first()->con_meta_keywords }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{!! $title !!}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:image" content="{{ $image }}">
    <meta property="og:image:alt" content="{!! $title !!}">
    <!--Open Graph / Twitter -->
    <meta name="twitter:card" content="summary">
    </meta>
    <meta property="twitter:type" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{!! $title !!}">
    <meta property="twitter:description" content="{{ $description }}">
    <meta property="twitter:image" content="{{ $image }}">



    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo/logo.png') }}" />

    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/fonts/iconic/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('resources/css/login.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('resources/css/new.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('resources/lib/all.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

    </style>


    <script> let base_url = '{{env('BASE_URL')}}'; let routeCart = '{{route('cart')}}';</script>
    <!-- Other CSS -->
    <script src="{{ asset('/assets/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('/resources/js/script.js') }}"></script>

    <!-- Font Awesome JS -->
    <script src="https://use.fontawesome.com/cde4a1d24d.js"></script>

    <!-- Login/Register Modal -->
    <script src="{{ asset('/assets/api/login.js') }}"></script>
    <script src="{{ asset('/assets/api/register.js') }}"></script>

    <!-- Cart -->
    <script src="{{ asset('/assets/api/api.js') }}"></script>
    <script src="{{ asset('/assets/api/cart.js') }}"></script>

    

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-38E4KHTKJL"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-38E4KHTKJL');
    </script>
    <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@type": "Organization",
            "name": "{{ $shop->title }}",
            "description": "{{ $config->first()->con_meta_description }}",
            "logo": "{{ url_image($shop->logo) }}",
            "alternateName": "{{ $shop->title }}",
            "url": "{{ route('home') }}",
            "sameAs": [
                "{{ route('home') }}"
                @if ($config->first()->con_page_fb != null && $config->first()->con_page_fb != ''),
                    "{{ $config->first()->con_page_fb }}"
                @endif

                @if ($config->first()->con_link_twitter != null && $config->first()->con_link_twitter != ''),
                    "{{ $config->first()->con_link_twitter }}"
                @endif

                @if ($config->first()->con_link_insta != null && $config->first()->con_link_insta != ''),
                    "{{ $config->first()->con_link_insta }}"
                @endif
            ]
        }
    </script>
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebSite",
            "url": "{{ route('home') }}",
            "potentialAction": {
                "@type": "SearchAction",
                "target": "{{ route('search') }}?q={keyword}",
                "query-input": "name=keyword"
            }
        }
    </script>
    <link rel="canonical" href="{!! explode('?', url()->current(), 2)[0] !!}" />
    @yield('script-header')
</head>

<body>
    @yield('main')
    <script>
        $(function() {
            //using jquery to loop each li element and automatically add an arrow span if the element contains a child of ul list
            $('#category-menu ul li').each(function() {
                if ($(this).find('ul').length > 0) {
                    $(this).addClass("has-child");
                    $(this).prepend("<span class='arrow'></span>");
                }
            });

            //bind an event to the li link that contains a child of ul list.
            $('#category-menu ul > li.has-child a').on("click", function(event) {
                var currentArrow = $(this).parent().find(" > span");
                if ($(currentArrow).length > 0) {
                    if ($(currentArrow).attr("class").indexOf("arrow-up") > 0) {
                        $(currentArrow).removeClass("arrow-up");
                        $(currentArrow).parent().find(" > ul").slideUp();
                    } else {
                        $(currentArrow).addClass("arrow-up");
                        $(currentArrow).parent().find(" > ul").slideDown();
                    }
                }
            });
        });
    </script>

    <script src="{{ asset('/assets/vendor/animsition/js/animsition.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('/assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/vendor/slick/slick.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/parallax100/parallax100.js') }}"></script>
    <script>
        $('.parallax100').parallax100();
    </script>
    <script src="{{ asset('/assets/vendor/MagnificPopup/jquery.magnific-popup.min.js') }}"></script>
    <script>
        $('.gallery-lb').each(function() { // the containers for all your galleries
            $(this).magnificPopup({
                delegate: 'a', // the selector for gallery item
                type: 'image',
                gallery: {
                    enabled: true
                },
                mainClass: 'mfp-fade'
            });
        });
    </script>
    <script src="{{ asset('/assets/vendor/isotope/isotope.pkgd.min.js') }}"></script>

    {{-- <script>
        $('.js-addwish-b2, .js-addwish-detail').on('click', function(e) {
            e.preventDefault();
        });

        $('.js-addwish-b2').each(function() {
            var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
            $(this).on('click', function() {
                swal(nameProduct, "is added to wishlist !", "success");

                $(this).addClass('js-addedwish-b2');
                $(this).off('click');
            });
        });

        $('.js-addwish-detail').each(function() {
            var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

            $(this).on('click', function() {
                swal(nameProduct, "is added to wishlist !", "success");
                $(this).addClass('js-addedwish-detail');
                $(this).off('click');
            });
        });

        /*---------------------------------------------*/

        $('.js-addcart-detail').each(function() {
            var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
            $(this).on('click', function() {
                swal(nameProduct, "is added to cart !", "success");
            });
        });
    </script> --}}

    <script src="{{ asset('/assets/vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script>
        $('.js-pscroll').each(function() {
            $(this).css('position', 'relative');
            $(this).css('overflow', 'hidden');
            var ps = new PerfectScrollbar(this, {
                wheelSpeed: 1,
                scrollingThreshold: 1000,
                wheelPropagation: false,
            });

            $(window).on('resize', function() {
                ps.update();
            })
        });
    </script>

    <script src="{{ asset('/assets/js/main.js') }}"></script>

    <!-- Jquery -->

    <script src="{{ asset('assets/js/jquery-migrate-3.0.0.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
    <!-- Popper JS -->
    <script src="{{ asset('/assets/js/popper.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('/assets/js/bootstrap.min.js') }}"></script>

    <!--Slicknav JS -->
    <script src="{{ asset('/assets/js/slicknav.min.js') }}"></script>

    <!-- Magnific Popup JS -->
    <script src="{{ asset('/assets/js/magnific-popup.js') }}"></script>
    <!-- Fancybox JS -->
    <script src="{{ asset('/assets/js/facnybox.min.js') }}"></script>
    <!-- Waypoints JS -->
    <script src="{{ asset('/assets/js/waypoints.min.js') }}"></script>
    <!-- Jquery Counterup JS -->
    <!-- <script src="{{ asset('/assets/js/jquery-counterup.min.js') }}"></script>-->
    <!-- Countdown JS -->
    <script src="{{ asset('/assets/js/finalcountdown.min.js') }}"></script>
    <!-- Nice Select JS -->
    <script src="{{ asset('/assets/js/nicesellect.js') }}"></script>
    <!-- Ytplayer JS -->
    <script src="{{ asset('/assets/js/ytplayer.min.js') }}"></script>
    <!-- Flex Slider JS -->
    <script src="{{ asset('/assets/js/flex-slider.js') }}"></script>
    <!-- ScrollUp JS -->
    <script src="{{ asset('/assets/js/scrollup.js') }}"></script>
    <!-- Onepage Nav JS -->
    <script src="{{ asset('/assets/js/onepage-nav.min.js') }}"></script>
    <!-- Easing JS -->
    <script src="{{ asset('/assets/js/easing.js') }}"></script>
    <!-- Active JS -->
    <script src="{{ asset('/assets/js/toggleclass.js') }}"></script>
    <script src="{{ asset('/assets/js/active.js') }}"></script>
    @yield('script-footer')
</body>

</html>
