<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Title -->
    <title>{{ isset($title) ? $title . ' - ' : '' }} {{ config('app.name') }}</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignZone">
    <meta name="robots" content="">

    @isset($title)
        <meta property="og:title" content="{{ $title }}">
    @endisset


    @isset($keywords)
        <meta name="keywords" content="{{ $keywords }}">
    @endisset

    @isset($description)
        <meta name="description" content="{{ $description }}">

        <meta property="og:description" content="{{ $description }}">
    @endisset

    <meta property="og:image"
        content="{{ isset($image) ? $image : 'https://swigo.dexignzone.com/xhtml/social-home.png' }}">

    <meta name="format-detection" content="telephone=no">

    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">

    <!-- Stylesheet -->
    <link href="{{ asset('front/swigo/assets/vendor/animate/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('front/swigo/assets/vendor/magnific-popup/magnific-popup.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front/swigo/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front/swigo/assets/vendor/bootstrap-select/css/bootstrap-select.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('front/swigo/assets/vendor/tempus-dominus/css/tempus-dominus.min.css') }}" rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="{{ asset('front/swigo/assets/vendor/rangeslider/rangeslider.css') }}">
    <link rel="stylesheet" href="{{ asset('front/swigo/assets/vendor/switcher/switcher.css') }}">
    <link rel="stylesheet" href="{{ asset('front/swigo/assets/css/style.css') }}">
    <link class="skin" rel="stylesheet" href="{{ asset('front/swigo/assets/css/skin/skin-1.css') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link
        href="../css2?family=Lobster&family=Lobster+Two:ital,wght@0,400;0,700;1,400;1,700&family=Poppins:ital,wght@0,100;0,200;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.min.css"
    integrity="sha512-UiKdzM5DL+I+2YFxK+7TDedVyVm7HMp/bN85NeWMJNYortoll+Nd6PU9ZDrZiaOsdarOyk9egQm6LOJZi36L2g==" crossorigin="anonymous"
    referrerpolicy="no-referrer" />
    @vite(['resources/js/app.js'])


    @livewireStyles()


    @isset($head)
        {{ $head }}
    @endisset

</head>

<body id="bg">
    <div id="loading-area" class="loading-page-3">
        <img src="{{ asset('front/swigo/assets/images/loading.gif') }}" alt="">
    </div>
    <div class="page-wraper">
        <!-- Header -->
        <header class="site-header mo-left header header-transparent transparent-white style-1">
            <!-- Main Header -->
            <div class="sticky-header main-bar-wraper navbar-expand-lg">
                <div class="main-bar clearfix ">
                    <div class="container clearfix">

                        <!-- Website Logo -->
                        <div class="logo-header mostion">
                            <a href="/" class="anim-logo"><img style="width: 80px"  src="{{ asset('images/logo.png') }}" alt="Saltanat"></a>
                        </div>

                        <!-- Nav Toggle Button -->
                        <button class="navbar-toggler collapsed navicon justify-content-end" type="button"
                            data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>

                        <!-- EXTRA NAV -->
                        <div class="extra-nav">
                            <div class="extra-cell">
                                <ul>
                                    <li>
                                        <a class="btn btn-white btn-square btn-shadow" data-bs-toggle="offcanvas"
                                            href="#offcanvasLogin" role="button" aria-controls="offcanvasLogin">
                                            <i class="flaticon-user"></i>
                                        </a>
                                    </li>
                                    <li>
                                        @livewire('users.guest.v2.modal.cart')
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- EXTRA NAV -->

                        <!-- Header Nav -->
                        <div class="header-nav navbar-collapse collapse justify-content-end" id="navbarNavDropdown">
                            <div class="logo-header">
                                <a href="/" class="anim-logo"><img style="width: 80px" src="{{ asset('images/logo.png') }}"
                                        alt="Saltanat"></a>
                            </div>
                            <ul class="nav navbar-nav navbar">
                                <li><a href="/">Home</a>
                                </li>
                                <li>
                                    <a href="{{ route('guest.menu') }}">Menu</a>
                                </li>
                            </ul>
                            <div class="dz-social-icon">
                                <ul>
                                    <li><a target="_blank" class="fab fa-facebook-f"
                                            href="https://www.facebook.com/"></a></li>
                                    <li><a target="_blank" class="fab fa-twitter" href="https://twitter.com/"></a>
                                    </li>
                                    <li><a target="_blank" class="fab fa-linkedin-in"
                                            href="https://www.linkedin.com/"></a></li>
                                    <li><a target="_blank" class="fab fa-instagram"
                                            href="https://www.instagram.com/"></a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Main Header End -->
        </header>
        <!-- Header -->


        <main>
            {{ $slot }}
        </main>

        <!--Footer-->
        <footer class="site-footer  style-1 bg-dark" id="footer">
            <div class="footer-top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-5 wow fadeInUp" data-wow-delay="0.5s">
                            <div class="widget widget_getintuch">
                                <h5 class="footer-title">Contact</h5>
                                <ul>
                                    <li>
                                        <i class="flaticon-placeholder"></i>
                                        <p>118, Near Old Drive Inn Cinema, Stadium Road Karachi</p>
                                    </li>
                                    <li>
                                        <i class="flaticon-telephone"></i>
                                        <p>03351271277</p>
                                    </li>
                                    <li>
                                        <i class="flaticon-email-1"></i>
                                        <p>order@saltanatrestaurant.com</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-3 col-6 wow fadeInUp" data-wow-delay="0.6s">
                            <div class="widget widget_services">
                                <h5 class="footer-title">Our Links</h5>
                                <ul>
                                    <li><a href="#"><span>Home</span></a></li>
                                    <li><a href="#"><span>About Us</span></a></li>
                                    <li><a href="#"><span>Services</span></a></li>
                                    <li><a href="#"><span>Team</span></a></li>
                                    <li><a href="#"><span>Blog</span></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-3 col-6 wow fadeInUp" data-wow-delay="0.7s">
                            <div class="widget widget_services">
                                <h5 class="footer-title">Help Center</h5>
                                <ul>
                                    <li><a href="#"><span>FAQ</span></a></li>
                                    <li><a href="#"><span>Shop</span></a></li>
                                    <li><a href="#"><span>Category Filter</span></a></li>
                                    <li><a href="#"><span>Testimonials</span></a></li>
                                    <li><a href="#"><span>Contact Us</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer Bottom Part -->
            <div class="container">
                <div class="footer-bottom">
                    <div class="row">
                        <div class="col-xl-6 col-md-6 text-md-start">
                            <p>Copyright 2023 All rights reserved.</p>
                        </div>
                        <div class="col-xl-6 col-md-6 text-md-end">
                            <span class="copyright-text">Developed by <a href="https://livebits.pk/"
                                    target="_blank">LiveBits</a></span>
                        </div>
                    </div>
                </div>
            </div>
            <img class="bg1 dz-move" src="assets/images/background/pic5.png" alt="/">
            <img class="bg2 dz-move" src="assets/images/background/pic6.png" alt="/">
        </footer>

        <!-- Footer -->
        <div class="scroltop-progress scroltop-primary">
            <svg width="100%" height="100%" viewbox="-1 -1 102 102">
                <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"></path>
            </svg>
        </div>


    </div>
</body>
<!-- JAVASCRIPT FILES ========================================= -->
<script src="{{ asset('front/swigo/assets/js/jquery.min.js') }}"></script><!-- JQUERY.MIN JS -->
<script src="{{ asset('front/swigo/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script><!-- BOOTSTRAP.MIN JS -->
<script src="{{ asset('front/swigo/assets/vendor/bootstrap-select/js/bootstrap-select.min.js') }}"></script><!-- BOOTSTRAP SELEECT -->
<script src="{{ asset('front/swigo/assets/vendor/magnific-popup/magnific-popup.js') }}"></script><!-- MAGNIFIC POPUP JS -->
<script src="{{ asset('front/swigo/assets/vendor/masonry/masonry-4.2.2.js') }}"></script><!-- MASONRY -->
<script src="{{ asset('front/swigo/assets/vendor/masonry/isotope.pkgd.min.js') }}"></script><!-- ISOTOPE -->
<script src="{{ asset('front/swigo/assets/vendor/imagesloaded/imagesloaded.js') }}"></script><!-- IMAGESLOADED -->
<script src="{{ asset('front/swigo/assets/vendor/counter/waypoints-min.js') }}"></script><!-- WAYPOINTS JS -->
<script src="{{ asset('front/swigo/assets/vendor/wow/wow.js') }}"></script><!-- WOW JS -->
<script src="{{ asset('front/swigo/assets/vendor/counter/counterup.min.js') }}"></script><!-- COUNTERUP JS -->
<script src="{{ asset('front/swigo/assets/vendor/swiper/swiper-bundle.min.js') }}"></script><!-- OWL-CAROUSEL -->
<script src="{{ asset('front/swigo/assets/vendor/popper/popper.js') }}"></script><!-- Popper -->
<script src="{{ asset('front/swigo/assets/vendor/tempus-dominus/js/tempus-dominus.min.js') }}"></script><!-- Tempus Dominus -->
<script src="{{ asset('front/swigo/assets/js/dz.carousel.min.js') }}"></script><!-- OWL-CAROUSEL -->
<script src="{{ asset('front/swigo/assets/vendor/bootstrap-touchspin/bootstrap-touchspin.js') }}"></script><!-- TOUCHSPIN -->
<script src="{{ asset('front/swigo/assets/js/custom.min.js') }}"></script><!-- CUSTOM JS -->
<script src="{{ asset('front/swigo/assets/vendor/rangeslider/rangeslider.js') }}"></script><!-- CUSTOM JS -->
{{-- <script src="{{ asset('front/swigo/assets/vendor/switcher/switcher.js') }}"></script><!-- CUSTOM JS --> --}}
{{-- Toastify --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.min.js"
    integrity="sha512-79j1YQOJuI8mLseq9icSQKT6bLlLtWknKwj1OpJZMdPt2pFBry3vQTt+NZuJw7NSd1pHhZlu0s12Ngqfa371EA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="{!! asset('backend/js/jquery.inputmask.min.js') !!}"></script>
<script src="{{ asset('backend/js/functions.js') }}"></script>



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

@isset($foot)
    {{ $foot }}
@endisset

@livewireScripts()

</html>
