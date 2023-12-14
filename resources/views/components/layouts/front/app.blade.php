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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.min.css"
        integrity="sha512-UiKdzM5DL+I+2YFxK+7TDedVyVm7HMp/bN85NeWMJNYortoll+Nd6PU9ZDrZiaOsdarOyk9egQm6LOJZi36L2g==" crossorigin="anonymous"
        referrerpolicy="no-referrer" />

    @vite(['resources/js/app.js'])

    @isset($head)
        {{ $head }}
    @endisset

    @livewireStyles
</head>

<body class="home-one dark">

    <!-- header style two -->

    <!-- header area start -->
    <header class="header-one header--sticky">
        <div class="header-one-container">
            <div class="row">
                <div class="col-12">
                    <div class="header-main-wrapper">
                        <div class="logo-area">
                            <a href="{{ route('guest.index') }}" class="logo">
                                <img src="{{ asset('front/assets/images/logo/01.svg') }}" alt="image-logo">
                            </a>
                        </div>
                        <div class="menu-area" id="menu-btn">
                            <a href="#" class="nav-menu-link menu-button">
                                <span class="dot1"></span>
                                <span class="dot2"></span>
                                <span class="dot3"></span>
                                <span class="dot4"></span>
                            </a>
                        </div>
                        <div class="rts-header-mid d-none d-lg-block">
                            <!-- nav area start -->
                            <div class="main-nav-desk nav-area">
                                <nav>
                                    <ul>
                                        @foreach ($headerNavigations as $singleNavigation)
                                            <li><a class="nav-link"
                                                    href="{{ $singleNavigation->url }}">{{ $singleNavigation->name }}</a>
                                            </li>
                                        @endforeach
                                        {{-- <li><a class="nav-link" href="#">Our Menu</a></li>
                                        <li><a class="nav-link" href="#">Our Deals</a></li>
                                        <li><a class="nav-link" href="#">Chef Special</a></li>
                                        <li><a class="nav-link" href="#">Contact</a></li> --}}
                                    </ul>
                                </nav>
                            </div>
                            <!-- nav-area end -->
                        </div>
                        <!-- header right start -->
                        <div class="rts-header-right">
                            <!-- bottom header start -->
                            <div class="bottom">
                                <div class="query-list">
                                    @livewire('users.guest.modal.cart')
                                </div>
                            </div>
                            <!-- bottom header end -->
                        </div>
                        <!-- header right end -->
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header area end -->

    <main>
        <!-- side bar for desktop -->
        <div id="side-bar" class="side-bar header-one">
            <div class="inner">
                <button class="close-icon-menu"><i class="far fa-times"></i></button>
                <!-- inner menu area desktop start -->
                <div class="inner-main-wrapper-desk d-none d-lg-block">
                    <div class="thumbnail">
                        <img src="{{ asset('front/assets/images/logo/footer-logo.svg') }}" alt="dinenos">
                    </div>
                    <div class="banner-shape-area">
                        <span class="shape"></span>
                        <span class="shape"></span>
                        <span class="shape"></span>
                    </div>
                    <div class="inner-content">
                        <ul class="feature-list">
                            <li class="query-list">
                                <span class="sub-text">118, Near Old Drive Inn Cinema, Stadium Road Karachi</span>
                                <a class="phone" href="tel:+923351271277">03351271277</a>
                                <a class="email"
                                    href="mail-to:info@saltanatrestaurant.com">order@saltanatrestaurant.com</a>
                            </li>
                            <li class="query-list two">
                                <p class="time">Mon - Sun: 6:30PM - 12:30AM</p>
                            </li>
                        </ul>
                        <div class="footer">
                            <ul class="social-area">
                                <li><a href="https://www.facebook.com/saltanatrestaurantpk/" target="_blank"><i
                                            class="fa-brands fa-facebook-f"></i></a></li>
                                <li><a href="https://www.instagram.com/saltanatrestaurantpk/" target="_blank"><i
                                            class="fa-brands fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- mobile menu area start -->
                <div class="mobile-menu d-block d-lg-none">
                    <nav class="nav-main mainmenu-nav mt--30">
                        <ul class="mainmenu" id="mobile-menu-active">
                            @foreach ($headerNavigations as $singleNavigation)
                                <li><a href="{{ $singleNavigation->url }}">{{ $singleNavigation->name }}</a></li>
                            @endforeach
                        </ul>
                    </nav>

                    <div class="social-wrapper-one">
                        <ul>
                            <li>
                                <a href="https://www.facebook.com/saltanatrestaurantpk/" target="_blank">
                                    <i class="fa-brands fa-facebook-f"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/saltanatrestaurantpk/" target="_blank">
                                    <i class="fa-brands fa-instagram"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa-brands fa-youtube"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                @auth
                    <button type="button" type="submit" class="rts-btn btn-primary button mt-5 mx-lg-auto"
                        onclick="event.preventDefault(); localStorage.clear();  document.getElementById('logout-form').submit();">Logout</button>

                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
                        {{ csrf_field() }}
                    </form>
                @endauth

            </div>
            <!-- mobile menu area end -->
        </div>
        <!-- header style two End -->
        {{ $slot }}
    </main>

    <!-- rts footer area start -->
    <!-- rts footer area start -->
    <div class="rts-footer-one rts-section-gap2Top">
        <div class="shape-1"><img src="{{ asset('front/assets/images/footer/vector5.webp') }}" alt="shape"></div>
        <div class="shape-2"><img src="{{ asset('front/assets/images/footer/vector6.webp') }}" alt="shape"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- main footer area start -->
                    <div class="main-footer-wrapper-one">
                        <div class="single-footer-wized-one logo-area" data-sal="slide-up" data-sal-delay="150"
                            data-sal-duration="800">
                            <a href="index.html" class="logo">
                                <img src="{{ asset('front/assets/images/logo/footer-logo.svg') }}" alt="logo">
                            </a>
                            <p class="disc-f">
                                Be the first to know about new collections, special events, and what’s going on at Our
                                Place. We are creative
                            </p>
                            <div class="query-list">
                                <span class="sub-text">Book a table</span>
                                <a href="tel:+923351271277">
                                    <span class="text-heading">03351271277</span>
                                </a>
                            </div>
                        </div>
                        <div class="single-footer-wized-one get-in-touch" data-sal="slide-up" data-sal-delay="350"
                            data-sal-duration="800">
                            <div class="footer-header-two get-touch">
                                <h6 class="title">Get In Touch</h6>
                                <div class="get-touch">
                                    <ul>
                                        <li><i class="fa-solid fa-location-dot"></i>118, Near Old Drive Inn Cinema,
                                            Stadium Road Karachi</li>
                                        <li><a href="tel:+923351271277"><i
                                                    class="fa-solid fa-phone-flip"></i>03351271277</a></li>
                                        <li><a href="mailto:order@saltanatrestaurant.com"><i
                                                    class="fa-solid fa-envelope-open"></i>order@saltanatrestaurant.com</a>
                                        </li>
                                    </ul>
                                    <div class="rts-social-wrapper">
                                        <ul>
                                            <li><a href="https://www.facebook.com/saltanatrestaurantpk/"
                                                    target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                                            <li><a href="https://www.instagram.com/saltanatrestaurantpk/"
                                                    target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                                            <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-footer-wized-one pages" data-sal="slide-up" data-sal-delay="250"
                            data-sal-duration="800">
                            <div class="footer-header-two pages">
                                <h6 class="title">Explore</h6>
                                <div class="pages">
                                    <ul>
                                        @foreach ($footerNavigations as $singleNavigation)
                                            <li><a
                                                    href="{{ $singleNavigation->url }}">{{ $singleNavigation->name }}</a>
                                            </li>
                                        @endforeach
                                        {{-- <li><a href="#"> About Us</a></li>
                                        <li><a href="#"> Our Menu</a></li>
                                        <li><a href="#">Our Chef</a></li>
                                        <li><a href="#"> Reservation</a></li>
                                        <li><a href="#"> Contact Us</a></li> --}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="single-footer-wized-one gallery" data-sal="slide-up" data-sal-delay="550"
                            data-sal-duration="800">

                            <div class="gallery-item"><img src="{{ asset('front/assets/images/gallery/sm-01.jpg') }}"
                                    alt=""></div>
                            <div class="gallery-item"><img src="{{ asset('front/assets/images/gallery/sm-02.jpg') }}"
                                    alt=""></div>
                            <div class="gallery-item"><img src="{{ asset('front/assets/images/gallery/sm-03.jpg') }}"
                                    alt=""></div>
                            <div class="gallery-item"><img src="{{ asset('front/assets/images/gallery/sm-04.jpg') }}"
                                    alt=""></div>
                            <div class="gallery-item"><img src="{{ asset('front/assets/images/gallery/sm-05.jpg') }}"
                                    alt=""></div>
                            <div class="gallery-item"><img src="{{ asset('front/assets/images/gallery/sm-06.jpg') }}"
                                    alt=""></div>
                        </div>
                    </div>
                    <!-- ,main footer area end -->
                </div>
            </div>
        </div>

        <!-- copy right area start -->
        <div class="copyright-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="copyright-footer-one">
                            <p class="disc">
                                Developed by <a href="https://www.livebits.pk">LiveBits</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- copyright area end -->
    </div>
    <!-- rts footer area end -->
    <!-- rts footer area end -->

    <!-- header style two -->


    <div id="anywhere-home" class="">
    </div>

    <div id="loading-area" class="loading-page-3">
        <img src="{{ asset('front/assets/images/loading.gif') }}" alt="Saltanat" />
    </div>


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

    {{-- Toastify --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.min.js"
        integrity="sha512-79j1YQOJuI8mLseq9icSQKT6bLlLtWknKwj1OpJZMdPt2pFBry3vQTt+NZuJw7NSd1pHhZlu0s12Ngqfa371EA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript" src="{!! asset('backend/js/jquery.inputmask.min.js') !!}"></script>
    <script src="{{ asset('backend/js/functions.js') }}"></script>
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

            Livewire.on("itemAdded", () => {
                    Toastify({
                        text: "Item added",
                        gravity: "top",
                        position: 'center',
                        style: {
                            background: '#12b812'
                        }
                    }).showToast();
            })


        });
    </script>

    @livewireScripts()

</body>
@isset($foot)
    {{ $foot }}
@endisset

</html>
