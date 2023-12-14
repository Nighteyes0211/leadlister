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
    <link rel="manifest" href="{{ asset('manifest.json') }}">

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
        content="{{ isset($image) ? $image : asset('images/og-placeholder.webp') }}">

    <meta name="format-detection" content="telephone=no">

    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('front/assets/images/fav.svg') }}">

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
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lobster+Two:ital,wght@1,400;1,700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.min.css"
        integrity="sha512-UiKdzM5DL+I+2YFxK+7TDedVyVm7HMp/bN85NeWMJNYortoll+Nd6PU9ZDrZiaOsdarOyk9egQm6LOJZi36L2g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/js/app.js'])
    <link rel="stylesheet" href="{!! asset('backend/plugins/select2/select2.min.css') !!}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@5.0.15/dark.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" integrity="sha512-+EoPw+Fiwh6eSeRK7zwIKG2MA8i3rV/DGa3tdttQGgWyatG/SkncT53KHQaS5Jh9MNOT3dmFL0FjTY08And/Cw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @livewireStyles()


    @isset($head)
        {{ $head }}
    @endisset

</head>

<body id="bg">
    <div id="loading-area" class="loading-page-3">
        <img src="{{ asset('front/swigo/assets/images/loading.gif') }}" alt="">
    </div>


    @livewire('users.guest.modal.area.select')

    <div class="page-wraper">
        <!-- Header -->
        <header class="site-header mo-left header header-transparent transparent-white style-1">
            <!-- Main Header -->
            <div class="sticky-header main-bar-wraper navbar-expand-lg">
                <div class="main-bar clearfix ">
                    <div class="container clearfix">

                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Website Logo -->
                            <div class="logo-header mostion my-3">
                                <a href="{{ route('guest.index') }}"><img style="width: 150px" src="{{ asset('images/logo.png') }}"
                                        alt="Saltanat"></a>
                            </div>



                            <div class="d-flex gap-2 align-items-center justify-content-end">

                                <!-- Header Nav -->
                                <div class="header-nav navbar-collapse collapse pt-0 justify-content-end" id="navbarNavDropdown">
                                    <div class="logo-header">
                                        <a href="{{ route('guest.menu') }}" class=""><img style="width: 80px"
                                                src="{{ asset('images/logo.png') }}" alt="Saltanat"></a>
                                    </div>
                                    <ul class="nav navbar-nav navbar">

                                        @foreach ($headerNavigations as $singleNavigation)
                                            <li>
                                                <a class="fw-semibold"
                                                    href="{{ $singleNavigation->url }}">{{ $singleNavigation->name }}</a>
                                            </li>
                                        @endforeach

                                    </ul>
                                    <div class="dz-social-icon">
                                        <ul>
                                            <li><a target="_blank" href="" class="fab fa-facebook-f"
                                                    href="https://www.facebook.com/saltanatrestaurantpk/"></a></li>
                                            <li><a target="_blank" class="fab fa-instagram"
                                                    href="https://instagram.com/saltanatrestaurantpk"></a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>

                                 <!-- EXTRA NAV -->
                                 <div class="d-flex justify-content-end">
                                    <div class="extra-cell">
                                        <ul class="d-flex align-items-center gap-2">
                                            <li>
                                                @livewire('users.guest.v2.comp.area')
                                            </li>
                                            <li>
                                                @livewire('users.guest.v2.modal.cart')
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- EXTRA NAV -->
                                <!-- Nav Toggle Button -->
                                <button class="navbar-toggler collapsed mt-0 navicon justify-content-end" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                                    aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </button>


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
        {{-- <section class="content-inner section-wrapper-6 p-b40 p-t45">
            <div class="container contact-area p-4 pb-10"
                style="background-image:url('assets/images/background/pic13.png'); background-attachment: fixed;">
                <div class="row d-flex align-items-center justify-content-center pb-4">
                    <div class="col-lg-3 m-b20">
                        <div class="dz-media faq-media move-2">
                            <img src="{{ asset('front/swigo/assets/images/faq/pic1.png') }}" alt="/">
                        </div>
                    </div>
                    <div class="col-lg-7 m-b20">
                        <div class="faq-info">
                            <h2 class="title text-white">Newsletter</h2>
                            <p class="m-b30 text-white">We hope this newsletter finds you well. We are excited to
                                announce some new additions to our menu that we think you'll love. Our culinary team has
                                been</p>

                            @livewire("users.guest.newsletter")

                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
        <!--Footer-->
        <footer class="site-footer style-2" id="footer">
            <div class="footer-bg-wrapper" id="app-banner">
                <div class="footer-top">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 wow fadeInUp" data-wow-delay="0.4s">
                                <div class="widget widget_servicess">
                                    <div class="footer-logo d-flex flex-column align-items-center">
                                        <a href="index.php" class="mb-4 mt-0">
                                            <img src="{{ asset('images/logo.png') }}" alt="Saltanat">
                                        </a>
                                        <ul class="d-flex justify-content-center">
                                            <li class="ms-0">
                                                <a target="_blank"
                                                    href="https://www.facebook.com/saltanatrestaurantpk/"><i
                                                        class="fa-brands fa-facebook"></i></a>
                                            </li>
                                            <li>
                                                <a target="_blank"
                                                    href="https://instagram.com/saltanatrestaurantpk"><i
                                                        class="fa-brands fa-instagram"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-3 col-md-6 col-sm-6 d-flex flex-column">
                                <div class="wiget widget_getintuch">
                                    <h5 class="footer-title">Contact us</h5>
                                    <ul>
                                        <li>
                                            <i class="flaticon-placeholder"></i>
                                            <p>118, Near Old Drive Inn Cinema, Stadium Road Karachi</p>
                                        </li>
                                        <li>
                                            <i class="flaticon-telephone"></i>
                                            <p><a href="tel:021 111-111-771">111-111-771</a></p>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-3 col-md-6 col-sm-6 d-flex flex-column">
                                <div class="wiget widget_getintuch">
                                    <h5 class="footer-title">Timings & order</h5>
                                    <ul>
                                        <li>
                                            <i class="flaticon-clock"></i>
                                            <p>Mon - Sun: 6:30 PM - 1:00 AM</p>
                                        </li>
                                        <li>
                                            <i class="flaticon-email-1"></i>
                                            <p>order@saltanatrestaurant.com</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            {{-- <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6	">
                                <div class="widget widget_getintuch">
                                    <h5 class="footer-title">Contact</h5>
                                    <ul>
                                        <li>
                                            <i class="flaticon-placeholder"></i>
                                            <p>118, Near Old Drive Inn Cinema, Stadium Road Karachi</p>
                                        </li>
                                        <li>
                                            <i class="flaticon-telephone"></i>
                                            <p>0335 1271277</p>
                                        </li>
                                        <li>
                                            <i class="flaticon-clock"></i>
                                            <p>Mon - Sat: 6:30 PM - 12:30 AM <br>
                                                Sunday: 6:30 PM - 12:30 AM</p>
                                        </li>
                                        <li>
                                            <i class="flaticon-email-1"></i>
                                            <p>order@saltanatrestaurant.com</p>
                                        </li>
                                    </ul>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer Bottom Part -->
            <div class="container">
                <div class="footer-bottom">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 text-center">
                            <span class="copyright-text">Copyright © 2023 All rights reserved.</span>
                            <span class="copyright-text">Developed by <a class="fw-bold text-black"
                                    href="https://livebits.pk/" target="_blank">LiveBits</a></span>
                        </div>
                        {{-- <div class="col-xl-6 col-lg-6">
                            <ul class="footer-link">
                                <li><a href="#">Privacy policy</a></li>
                                <li><a href="#">Terms & conditions</a></li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
            </div>
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
<script src="{{ asset('front/swigo/assets/js/custom.js') }}"></script><!-- CUSTOM JS -->

<script src="{{ asset('front/swigo/assets/vendor/rangeslider/rangeslider.js') }}"></script><!-- CUSTOM JS -->
{{-- <script src="{{ asset('front/swigo/assets/vendor/switcher/switcher.js') }}"></script><!-- CUSTOM JS --> --}}
{{-- Toastify --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.min.js"
    integrity="sha512-79j1YQOJuI8mLseq9icSQKT6bLlLtWknKwj1OpJZMdPt2pFBry3vQTt+NZuJw7NSd1pHhZlu0s12Ngqfa371EA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="{!! asset('backend/js/jquery.inputmask.min.js') !!}"></script>

<script type="text/javascript" src="{!! asset('backend/plugins/select2/select2.full.min.js') !!}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="{{ asset('backend/js/functions.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js" integrity="sha512-IsNh5E3eYy3tr/JiX2Yx4vsCujtkhwl7SLqgnwLNgf04Hrt9BT9SXlLlZlWx+OK4ndzAoALhsMNcCmkggjZB1w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script>
    document.addEventListener("livewire:load", function() {


        Livewire.on("newsletterSubscribed", () => {
                Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Thanks for subscribing!',
                showConfirmButton: false,
                timer: 2000
            })
        })

        Livewire.on("closeModal", (modalId) => {

            let modal = document.getElementById(`${modalId}`);
            modal.querySelector('.btn-close').click();

        });


        Livewire.on("openModal", (modalId) => {
            $(`#${modalId}-opener`).click();

        });

        Livewire.on("itemAdded", () => {

            if ($(".item-added-toast").length > 0) {
                $(".item-added-toast").remove();
            }
            Toastify({
                text: "Item added",
                className: 'item-added-toast',
                gravity: "top",
                position: 'center',
                style: {
                    background: '#12b812'
                }
            }).showToast();
        })

        Livewire.on("toast", (e) => {
            if ($(".notification" + (e.toast ?? 'Success').replace(/\s/g, '')).length > 0) {
                $(".notification" + (e.toast ?? 'Success').replace(' ', '')).remove();
            }

            Toastify({
                text: e.message ?? 'Success',
                className: "notification" + e.toast,
                gravity: "top",
                position: 'center',
            }).showToast();
        })


    });
</script>

@isset($foot)
    {{ $foot }}
@endisset

@livewireScripts()

</html>
