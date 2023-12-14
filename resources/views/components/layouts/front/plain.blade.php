<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('front/assets/images/fav.svg') }}">
    <title>Saltanat Restaurant</title>

    <!-- fontawesome css -->
    <link rel="stylesheet" href="{{ asset('front/assets/css/plugins/fontawesome-5.css') }}">
    <!-- fontawesome css -->
    <link rel="stylesheet" href="{{ asset('front/assets/css/plugins/swiper.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/plugins/unicons.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/plugins/metismenu.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/plugins/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/plugins/timepickers.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/plugins/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/plugins/hover-revel.css') }}">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{ asset('front/assets/css/vendor/bootstrap.min.css') }}">
    <!-- main css -->
    <link rel="stylesheet" href="{{ asset('front/assets/css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('front/assets/css/custom.css') }}">

    @vite(['resources/js/app.js'])

    @isset($head)
        {{ $head }}
    @endisset

    @livewireStyles
</head>

<body class="home-one dark">


    <main>
        <!-- header style two End -->
        {{ $slot }}
    </main>



    <div id="anywhere-home" class="">
    </div>

    <!-- pre loader start -->
    <div id="loading-area" class="loading-page-3">
        <img src="{{ asset('front/assets/images/loading.gif') }}" alt="Saltanat" />
    </div>
    <!-- pre loader end -->


    <!-- progress area start -->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"
                style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;">
            </path>
        </svg>
    </div>
    <!-- progress area end -->

    <div class="search-input-area">
        <div class="container">
            <div class="search-input-inner">
                <div class="input-div">
                    <input id="searchInput1" class="search-input" type="text"
                        placeholder="Search by keyword or #">
                    <button><i class="far fa-search"></i></button>
                </div>
            </div>
        </div>
        <div id="close" class="search-close-icon"><i class="far fa-times"></i></div>
    </div>


    <!-- jquery js -->
    <script src="{{ asset('front/assets/js/plugins/jquery.min.js') }}"></script>
    <!-- jquery ui -->
    <script src="{{ asset('front/assets/js/vendor/jqueryui.js') }}"></script>
    <!-- counter up -->
    <script src="{{ asset('front/assets/js/plugins/counter-up.js') }}"></script>
    <script src="{{ asset('front/assets/js/plugins/swiper.js') }}"></script>
    <!-- twinmax -->
    <script src="{{ asset('front/assets/js/vendor/twinmax.js') }}"></script>
    <!-- twinmax -->
    <script src="{{ asset('front/assets/js/vendor/aos.js') }}"></script>
    <!-- twinmax -->
    <script src="{{ asset('front/assets/js/vendor/isotope.pkgd.min.js') }}"></script>
    <!-- split text js -->
    <script src="{{ asset('front/assets/js/vendor/split-text.js') }}"></script>
    <!-- text plugins -->
    <script src="{{ asset('front/assets/js/plugins/text-plugins.js') }}"></script>
    <!-- waypoint js -->
    <script src="{{ asset('front/assets/js/plugins/metismenu.js') }}"></script>
    <!-- metismenu js -->
    <script src="{{ asset('front/assets/js/plugins/waypoint.js') }}"></script>
    <!-- metismenu js -->
    <script src="{{ asset('front/assets/js/vendor/metisMenu.min.js') }}"></script>
    <!-- waw -->
    <script src="{{ asset('front/assets/js/vendor/wow.js') }}"></script>
    <!-- jquery ui js -->
    <script src="{{ asset('front/assets/js/plugins/jquery-ui.js') }}"></script>
    <!-- jquery ui js -->
    <script src="{{ asset('front/assets/js/plugins/jquery-timepicker.js') }}"></script>
    <!-- magnific popup js -->
    <script src="{{ asset('front/assets/js/plugins/magnific-popup.js') }}"></script>
    <!-- sal animation -->
    <script src="{{ asset('front/assets/js/vendor/sal.min.js') }}"></script>
    <!-- bootstrap JS -->
    <script src="{{ asset('front/assets/js/plugins/bootstrap.min.js') }}"></script>
    <!-- easing JS -->
    <script src="{{ asset('front/assets/js/plugins/jquery-slideNav.js') }}"></script>
    <!-- easing JS -->
    <script src="{{ asset('front/assets/js/vendor/hover-revel.js') }}"></script>
    <!-- easing JS -->
    <script src="{{ asset('front/assets/js/plugins/swip-img.js') }}"></script>
    <!-- main js -->
    <script src="{{ asset('front/assets/js/main.js') }}"></script>
    <!-- header style two End -->

    <script>
        document.addEventListener("livewire:load", function() {


            Livewire.on("closeModal", (modalId) => {

                let modal = document.getElementById(`${modalId}`);
                modal.querySelector('.btn-close').click();

            });


            Livewire.on("openModal", (modalId) => {

                $(`#${modalId}-opener`).click();

            });


        });
    </script>

    @livewireScripts()

</body>
@isset($foot)
    {{ $foot }}
@endisset

</html>
