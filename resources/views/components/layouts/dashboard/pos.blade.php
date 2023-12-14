<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <title>{{ isset($title) ? $title . ' - ' : '' }} {{ $website_name }}</title>
    <link rel="icon" href="{!! asset('images/logo.png') !!}" type="image/x-icon">
    <link rel="stylesheet" href="{!! asset('backend/plugins/bootstrap/css/bootstrap.css') !!}">
    <link rel="stylesheet" href="{!! asset('backend/css/style.css') !!}">
    <link rel="stylesheet" href="{!! asset('backend/css/plugins.css') !!}">
    <link rel="stylesheet" href="{!! asset('backend/css/animated.css') !!}">
    <link rel="stylesheet" href="{!! asset('backend/plugins/iconfonts/font-awesome/css/font-awesome.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('backend/plugins/iconfonts/feather/feather.css') !!}">
    <link rel="stylesheet" href="{!! asset('backend/plugins/iconfonts/typicons/typicons.css') !!}">
    <link rel="stylesheet" href="{!! asset('backend/plugins/datatable/css/dataTables.bootstrap5.css') !!}" />
    <link rel="stylesheet" href="{!! asset('backend/plugins/datatable/css/buttons.bootstrap5.min.css') !!}" />
    <link rel="stylesheet" href="{!! asset('backend/plugins/datatable/responsive.bootstrap5.css') !!}" />
    <link rel="stylesheet" href="{!! asset('backend/plugins/sweetalert/sweetalert.css') !!}" />
    <link rel="stylesheet" href="{!! asset('backend/css/jquery.nestable.css') !!}" />
    <link rel="stylesheet" href="{!! asset('backend/plugins/select2/select2.min.css') !!}" />
    <link rel="stylesheet" href="{!! asset('backend/plugins/select2/select2.min.css') !!}" />
    <link rel="stylesheet" href="{!! asset('backend/plugins/bootstrap-datepicker1/css/datepicker.css') !!}" />
    <link rel="stylesheet" href="{!! asset('backend/plugins/summer-note/summernote1.css') !!}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/accordion/accordion.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/custom.css') }}">

    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.min.css"
        integrity="sha512-UiKdzM5DL+I+2YFxK+7TDedVyVm7HMp/bN85NeWMJNYortoll+Nd6PU9ZDrZiaOsdarOyk9egQm6LOJZi36L2g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.css" integrity="sha512-rd0qOHVMOcez6pLWPVFIv7EfSdGKLt+eafXh4RO/12Fgr41hDQxfGvoi1Vy55QIVcQEujUE1LQrATCLl2Fs+ag==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>



    @vite(['resources/css/app.css', 'resources/js/app.js'])


    @isset($head)
        {{ $head }}
    @endisset

    @livewireStyles
</head>

<body class="app ltr light-mode horizontal">

    <!---Global-loader-->
    <div id="global-loader">
        <img src="{!! asset('backend/images/svgs/loader.svg') !!}" alt="loader">
    </div>

    <div class="page" id="mainNavShow">
        <div class="page-main">
            <!--app header-->
            <div class="header sticky hor-header">
                <div class="main-container container">
                    <div class="d-flex  justify-content-between">
                        <div class="d-flex gap-3">
                            <a href="{{ route('pos.dashboard') }}" class="header-brand">
                                <x-bootstrap.brand></x-bootstrap.bra>
                            </a>
                            <div class="app-sidebar__toggle" data-bs-toggle="sidebar">
                                <a class="open-toggle" href="javascript:void(0);">
                                    <i class="feather feather-menu"></i>
                                </a>
                                <a class="close-toggle" href="javascript:void(0);">
                                    <i class="feather feather-x"></i>
                                </a>
                            </div>
                        </div>


                        <div class="d-flex order-lg-2 my-auto">
                            <button class="navbar-toggler nav-link icon navresponsive-toggler vertical-icon ms-auto"
                                type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4"
                                aria-controls="navbarSupportedContent-4" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <i class="fe fe-more-vertical header-icons navbar-toggler-icon"></i>
                            </button>
                            <div
                                class="mb-0 navbar navbar-expand-lg navbar-nav-right responsive-navbar navbar-dark p-0">
                                <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                                    <div class="d-flex ms-auto">

                                        <div class="dropdown  d-flex">
                                            <a class="nav-link icon theme-layout nav-link-bg layout-setting">
                                                <span class="dark-layout"><i class="fe fe-moon"></i></span>
                                                <span class="light-layout"><i class="fe fe-sun"></i></span>
                                            </a>
                                        </div>

                                        <div class="dropdown profile-dropdown">
                                            <a href="#" class="nav-link pe-1 ps-0 leading-none"
                                                data-bs-toggle="dropdown">
                                                <span>
                                                    @if (auth()->user()->userInfo?->profile_image)
                                                        <img style="object-fit: cover"
                                                            src="{{ asset(\App\Models\User::$profile_image_path . auth()->user()->userInfo?->profile_image) }}"
                                                            alt="user-img" class="avatar avatar-md bradius">
                                                    @else
                                                        <img src="{!! asset('backend/images/users/16.jpg') !!}" alt="user-img"
                                                            class="avatar avatar-md bradius">
                                                    @endif
                                                </span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow animated">
                                                <div class="p-3 text-center border-bottom">
                                                    <a href=""
                                                        class="text-center user pb-0 font-weight-bold">{{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}</a>
                                                    <p class="text-center user-semi-title"> {{ auth()->user()->email }}
                                                    </p>
                                                </div>
                                                <a class="dropdown-item d-flex"
                                                    href="{{ route('organization.profile') }}">
                                                    <i class="feather feather-user me-3 fs-16 my-auto"></i>
                                                    <div class="mt-1">Profile</div>
                                                </a>

                                                <a class="dropdown-item d-flex" href="#"
                                                    onclick="event.preventDefault(); localStorage.clear();  document.getElementById('logout-form').submit();">
                                                    <i class="feather feather-power me-3 fs-16 my-auto"></i>
                                                    <div class="mt-1">Log Out</div>
                                                </a>

                                                <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                                    class="d-none">
                                                    {{ csrf_field() }}
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/app header-->
            <!--app-sidebar-->
            <div class="sticky">
                <!--aside open-->
                <aside class="app-sidebar horizontal-main hor-menu">
                    {{--            <div class="app-sidebar__logo"> --}}
                    {{--                <a class="header-brand" href="<?php echo url('/'); ?>"> --}}
                    {{--                    <img src="{!! asset('backend/images/brand/logo.png') !!}" class="header-brand-img desktop-lgo" alt=""> --}}
                    {{--                    <img src="{!! asset('backend/images/brand/logo-white.png') !!}" class="header-brand-img dark-logo" alt=""> --}}
                    {{--                    <img src="{!! asset('backend/images/brand/favicon.png') !!}" class="header-brand-img mobile-logo" alt=""> --}}
                    {{--                    <img src="{!! asset('backend/images/brand/favicon1.png') !!}" class="header-brand-img darkmobile-logo" alt=""> --}}
                    {{--                </a> --}}
                    {{--            </div> --}}
                    <div class="app-sidebar3 ps horizontal-mainwrapper container" style="margin-top:0px;">
                        <div class="main-menu is-expanded horizontalMenu">
                            <div class="app-sidebar__user">
                                <div class="dropdown user-pro-body text-center">
                                    <div>

                                        <img src="{{ asset('images/logo.png') }}" alt="user-img"
                                            class="avatar-xxl rounded-circle mb-1" style="object-fit: contain">
                                        {{-- @if (auth()->user()->userInfo?->profile_image)
                                            <img src="{{ asset(\App\Models\User::$profile_image_path . auth()->user()->userInfo?->profile_image) }}" alt="user-img"
                                                class="avatar-xxl rounded-circle mb-1">
                                        @else
                                            <img src="{!! asset('backend/images/users/16.jpg') !!}" alt="user-img"
                                                class="avatar-xxl rounded-circle mb-1">
                                        @endif --}}

                                    </div>
                                    <div class="user-info">
                                        <h5 class=" mb-2">
                                            {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }} </h5>
                                        <span class="text-muted app-sidebar__user-name text-sm">
                                            {{ auth()->user()->email }} </span>
                                    </div>
                                </div>
                            </div>
                            <ul class="side-menu flex-nowrap">
                                <li class="side-item side-item-category mt-4">Menus</li>
                                @include('users.pos.menu')
                            </ul>
                        </div>
                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div>
                        <div class="ps__rail-y" style="top: 0px; height: 790px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div>

                    </div>
                </aside>
                <!--aside closed-->
            </div>
            <!--app-sidebar closed-->
            <div class="main-content hor-content">
                <div class="main-container container">
                    <button class="d-none" id="playsound">Play sound</button>
                    <audio style="display: none" controls id="myAudio">
                        <source src="{{ asset('audio/new-order.mp3') }}" type="audio/mpeg">
                    </audio>

                    {{ $slot }}

                </div>
            </div><!-- end app-content-->
        </div>
        <footer class="footer">
            <div class="container">
                <div class="row align-items-center flex-row-reverse">
                    <div class="col-md-12 col-sm-12 mt-3 mt-lg-0 text-center">
                        Copyright © 2023 <a href="#">{{ $website_name }}</a>. Developed by <a
                            href="https://livebits.pk" target="_blank">LiveBits</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Back to top -->
    <a href="#top" id="back-to-top"><span class="feather feather-chevrons-up"></span></a>

    <script type="text/javascript" src="{!! asset('backend/plugins/jquery/jquery.min.js') !!}"></script>

    {{-- Toastify --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.min.js"
        integrity="sha512-79j1YQOJuI8mLseq9icSQKT6bLlLtWknKwj1OpJZMdPt2pFBry3vQTt+NZuJw7NSd1pHhZlu0s12Ngqfa371EA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- Swiper --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js" integrity="sha512-Ysw1DcK1P+uYLqprEAzNQJP+J4hTx4t/3X2nbVwszao8wD+9afLjBQYjz7Uk4ADP+Er++mJoScI42ueGtQOzEA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- Isotope --}}
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>

    <script type="text/javascript" src="{!! asset('backend/plugins/moment/moment.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('backend/plugins/bootstrap/js/popper.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('backend/plugins/bootstrap/js/bootstrap.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('backend/plugins/sidemenu/sidemenu.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('backend/plugins/p-scrollbar/p-scrollbar.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('backend/plugins/p-scrollbar/p-scroll1.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('backend/plugins/sidebar/sidebar.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('backend/js/sticky.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('backend/js/themeColors.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('backend/js/custom.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('backend/js/autoNumeric.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('backend/js/jquery.inputmask.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('backend/plugins/sweetalert/sweetalert.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('backend/plugins/datatable/js/jquery.dataTables.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('backend/plugins/datatable/js/dataTables.bootstrap5.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('backend/plugins/datatable/js/dataTables.buttons.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('backend/plugins/datatable/js/buttons.bootstrap5.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('backend/plugins/datatable/dataTables.responsive.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('backend/plugins/datatable/responsive.bootstrap5.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('backend/js/jquery.nestable.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('backend/plugins/select2/select2.full.min.js') !!}"></script>
    <script type="text/javascript" src="{{ asset('backend/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <script type="text/javascript" src="{!! asset('backend/plugins/summer-note/summernote1.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('backend/plugins/bootstrap-datepicker1/js/bootstrap-datepicker.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('backend/plugins/bootstrap-notify/bootstrap-notify.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('backend/js/jquery.validate.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('backend/js/jquery.form.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('backend/js/functions.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('backend/plugins/accordion/accordion.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('backend/plugins/chart/chart.bundle.js') !!}"></script>
    {{-- <script type="text/javascript" src="{{ asset('front/swigo/assets/vendor/bootstrap-touchspin/bootstrap-touchspin.js') }}"></script><!-- TOUCHSPIN --> --}}
    <script src="{{ asset('backend/plugins/jquery/block-ui.js') }}"></script>


    <script>
        $(document).ready(function() {
            $("body").trigger("click");
        });
        $(document).on("click", "#playsound", function() {
            if (document.getElementById("myAudio").paused) {
                document.getElementById("myAudio").play()
            }
        })



        $('.sumoselect').SumoSelect({
                csvDispCount: 3,
                search: true,
                searchText: 'Enter here.'
            });


        document.addEventListener('livewire:load', function() {

            Livewire.on("closeModal", (modalId) => {

                console.log('closing modal ');
                let modal = $(`#${modalId}`);
                let closeBtn = modal.find('.btn-close')
                closeBtn.click()

            });

            Livewire.on("openModal", (modalId) => {

                $(`#${modalId}-opener`).click();

            });

            Livewire.on("toast", (e) => {

                if ($(".notification" + (e.message ?? 'Success')).length > 0) {
                    $(".notification" + (e.message ?? 'Success')).remove();
                }

                Toastify({
                    text: e.message,
                    className: "notification" + e.message,
                    gravity: "top",
                    position: 'center',
                    style: {
                        background: '#12b812'
                    }
                }).showToast()

            })


        })
    </script>

    @isset($foot)
        {{ $foot }}
    @endisset

    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>


    @livewireScripts
</body>

</html>
