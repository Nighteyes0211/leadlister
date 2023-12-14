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
        <!-- Website Logo -->
        <div class="d-flex justify-content-center">
            <div class="logo-header plain border border-5 border-primary mt-3 bg-dark d-flex justify-content-center align-items-center mostion">
                <a href="/" class="anim-logo"><img src="{{ asset('images/logo.png') }}"
                        alt="Saltanat"></a>
            </div>
        </div>


        <main>
            {{ $slot }}
        </main>

        <!-- Footer -->
        <div class="scroltop-progress scroltop-primary">
            <svg width="100%" height="100%" viewbox="-1 -1 102 102">
                <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"></path>
            </svg>
        </div>


    </div>
</body>
<!-- JAVASCRIPT FILES ========================================= -->
{{-- <script src="{{ asset('front/swigo/assets/js/jquery.min.js') }}"></script><!-- JQUERY.MIN JS --> --}}
<script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
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
