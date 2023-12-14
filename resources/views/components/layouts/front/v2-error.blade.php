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
                        <div class="logo-header mostion my-3">
                            <a href="/"><img style="width: 150px" src="{{ asset('images/logo.png') }}"
                                    alt="Saltanat"></a>
                        </div>

                        <!-- Nav Toggle Button -->
                        {{-- <button class="navbar-toggler collapsed navicon justify-content-end" type="button"
                            data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button> --}}

                        <!-- EXTRA NAV -->
                        <div class="extra-nav">
                            <div class="extra-cell">
                                <ul>
                                    {{-- <li>
                                        <a class="btn btn-white btn-square btn-shadow" href="{{ route('login') }}"
                                            role="button">
                                            <i class="flaticon-user"></i>
                                        </a>
                                    </li> --}}
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

                        <!-- Header Nav -->
                        {{-- <div class="header-nav navbar-collapse collapse justify-content-end" id="navbarNavDropdown">
                            <div class="logo-header">
                                <a href="/" class=""><img style="width: 80px"
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
                        </div> --}}

                    </div>
                </div>
            </div>
            <!-- Main Header End -->
        </header>
        <!-- Header -->


        <main>
            {{ $slot }}
        </main>
        <section class="content-inner section-wrapper-6 p-b40 p-t45">
            <div class="container contact-area pb-10"
                style="background-image:url('assets/images/background/pic13.png'); background-attachment: fixed;">
                <div class="row d-flex align-items-center justify-content-center pb-4">
                    <div class="col-lg-3 m-b20 m-r100">
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
                            <form class="dzSubscribe" action="assets/script/mailchamp.php" method="post">
                                <div class="dzSubscribeMsg text-white"></div>
                                <div class="input-group">
                                    <input name="dzEmail" required="required" type="text" class="form-control"
                                        placeholder="Enter Your Email">
                                    <div class="input-group-addon">
                                        <button name="submit" value="submit" type="submit"
                                            class="btn btn-primary btn-hover-2">
                                            <span>Submit</span> <i class="fa-solid fa-paper-plane"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

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
            if ($(".notification" + (e.message ?? 'Success')).length > 0) {
                $(".notification" + (e.message ?? 'Success')).remove();
            }

            Toastify({
                text: e.message ?? 'Success',
                className: "notification" + e.message,
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
