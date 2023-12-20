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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.min.css"
        integrity="sha512-UiKdzM5DL+I+2YFxK+7TDedVyVm7HMp/bN85NeWMJNYortoll+Nd6PU9ZDrZiaOsdarOyk9egQm6LOJZi36L2g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>


    @isset($head)
        {{ $head }}
    @endisset

    @livewireStyles
</head>

<body class="app sidebar-mini ltr">

    <!---Global-loader-->
    <div id="global-loader">
        <img src="{!! asset('backend/images/svgs/loader.svg') !!}" alt="loader">
    </div>

    <div class="page" id="mainNavShow">
        <div class="page-main">
            <!--app header-->
            <div class="app-header header sticky">
                <div class="container-fluid main-container">
                    <div class="d-flex justify-content-between">
                        <div class="app-sidebar__toggle" data-bs-toggle="sidebar">
                            <a class="open-toggle" href="javascript:void(0);">
                                <i class="feather feather-menu"></i>
                            </a>
                            <a class="close-toggle" href="javascript:void(0);">
                                <i class="feather feather-x"></i>
                            </a>
                        </div>


                        <x-bootstrap.button data-bs-toggle="modal" data-bs-target="#reservation_create_modal"
                                    action="reservation:create" color="primary"
                                    class="create-reservation-btn d-none px-4">Reserve</x-bootstrap.button>

                        <div class="d-flex order-lg-2 my-auto">
                            @role(RoleEnum::SUPERADMINISTRATOR->value)
                                <form id="import-data-form" action="{{ route('organization.import.data') }}" method="POST">
                                    @csrf
                                    <input type="file" hidden name="file" id="file" accept=".csv">
                                    <label for="file" id="import-data" class="btn btn-primary mb-0">Import data</label>
                                </form>
                            @endrole
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
                                        {{--                                    <a class="nav-link  icon p-0 nav-link-lg d-lg-none navsearch"  href="javascript:void(0);" data-bs-toggle="search"> --}}
                                        {{--                                        <i class="feather feather-search search-icon header-icon"></i> --}}
                                        {{--                                    </a> --}}
                                        <div class="dropdown  d-flex">
                                            <a class="nav-link icon theme-layout nav-link-bg layout-setting">
                                                <span class="dark-layout"><i class="fe fe-moon"></i></span>
                                                <span class="light-layout"><i class="fe fe-sun"></i></span>
                                            </a>
                                        </div>
                                        <!--<div class="dropdown header-flags">
                                        <a class="nav-link icon" data-bs-toggle="dropdown">
                                            <img src="../backend/images/flags/flag-png/united-kingdom.png" class="h-24" alt="img">
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow animated">
                                            <a  href="javascript:void(0);" class="dropdown-item d-flex "> <span class="avatar  me-3 align-self-center bg-transparent"><img src="../backend/images/flags/flag-png/india.png" alt="img" class="h-24"></span>
                                                <div class="d-flex"> <span class="my-auto">India</span> </div>
                                            </a>
                                            <a  href="javascript:void(0);" class="dropdown-item d-flex"> <span class="avatar  me-3 align-self-center bg-transparent"><img src="../backend/images/flags/flag-png/united-kingdom.png" alt="img" class="h-24"></span>
                                                <div class="d-flex"> <span class="my-auto">UK</span> </div>
                                            </a>
                                            <a  href="javascript:void(0);" class="dropdown-item d-flex"> <span class="avatar me-3 align-self-center bg-transparent"><img src="../backend/images/flags/flag-png/italy.png" alt="img" class="h-24"></span>
                                                <div class="d-flex"> <span class="my-auto">Italy</span> </div>
                                            </a>
                                            <a  href="javascript:void(0);" class="dropdown-item d-flex"> <span class="avatar me-3 align-self-center bg-transparent"><img src="../backend/images/flags/flag-png/united-states-of-america.png" class="h-24" alt="img"></span>
                                                <div class="d-flex"> <span class="my-auto">US</span> </div>
                                            </a>
                                            <a  href="javascript:void(0);" class="dropdown-item d-flex"> <span class="avatar  me-3 align-self-center bg-transparent"><img src="../backend/images/flags/flag-png/spain.png" alt="img" class="h-24"></span>
                                                <div class="d-flex"> <span class="my-auto">Spain</span> </div>
                                            </a>
                                        </div>
                                    </div> -->
                                        {{-- <div class="dropdown header-fullscreen">
                                            <a class="nav-link icon full-screen-link">
                                                <i
                                                    class="feather feather-maximize fullscreen-button fullscreen header-icons"></i>
                                                <i
                                                    class="feather feather-minimize fullscreen-button exit-fullscreen header-icons"></i>
                                            </a>
                                        </div> --}}
                                        {{-- <div class="dropdown header-message">
                                            <a class="nav-link icon" data-bs-toggle="dropdown">
                                                <i class="feather feather-mail header-icon"></i>
                                                <span class="badge badge-success side-badge">5</span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow  animated">
                                                <div class="header-dropdown-list message-menu" id="message-menu">
                                                    <a class="dropdown-item border-bottom" href="chat.html">
                                                        <div class="d-flex align-items-center">
                                                            <div class="">
                                                                <span
                                                                    class="avatar avatar-md brround align-self-center cover-image"
                                                                    data-bs-image-src="../backend/images/users/1.jpg"></span>
                                                            </div>
                                                            <div class="d-flex">
                                                                <div class="ps-3 text-wrap text-break">
                                                                    <h6 class="mb-1">Jack Wright</h6>
                                                                    <p class="fs-13 mb-1">All the best your template
                                                                        awesome</p>
                                                                    <div class="small text-muted">
                                                                        3 hours ago
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <a class="dropdown-item border-bottom" href="chat.html">
                                                        <div class="d-flex align-items-center">
                                                            <div class="">
                                                                <span
                                                                    class="avatar avatar-md brround align-self-center cover-image"
                                                                    data-bs-image-src="../backend/images/users/2.jpg"></span>
                                                            </div>
                                                            <div class="d-flex">
                                                                <div class="ps-3 text-wrap text-break">
                                                                    <h6 class="mb-1">Lisa Rutherford</h6>
                                                                    <p class="fs-13 mb-1">Hey! there I'm available</p>
                                                                    <div class="small text-muted">
                                                                        5 hour ago
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <a class="dropdown-item border-bottom" href="chat.html">
                                                        <div class="d-flex align-items-center">
                                                            <div class="">
                                                                <span
                                                                    class="avatar avatar-md brround align-self-center cover-image"
                                                                    data-bs-image-src="../backend/images/users/3.jpg"></span>
                                                            </div>
                                                            <div class="d-flex">
                                                                <div class="ps-3 text-wrap text-break">
                                                                    <h6 class="mb-1">Blake Walker</h6>
                                                                    <p class="fs-13 mb-1">Just created a new blog post
                                                                    </p>
                                                                    <div class="small text-muted">
                                                                        45 mintues ago
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <a class="dropdown-item border-bottom" href="chat.html">
                                                        <div class="d-flex align-items-center">
                                                            <div class="">
                                                                <span
                                                                    class="avatar avatar-md brround align-self-center cover-image"
                                                                    data-bs-image-src="../backend/images/users/4.jpg"></span>
                                                            </div>
                                                            <div class="d-flex">
                                                                <div class="ps-3 text-wrap text-break">
                                                                    <h6 class="mb-1">Fiona Morrison</h6>
                                                                    <p class="fs-13 mb-1">Added new comment on your
                                                                        photo</p>
                                                                    <div class="small text-muted">
                                                                        2 days ago
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <a class="dropdown-item border-bottom" href="chat.html">
                                                        <div class="d-flex align-items-center">
                                                            <div class="">
                                                                <span
                                                                    class="avatar avatar-md brround align-self-center cover-image"
                                                                    data-bs-image-src="../backend/images/users/6.jpg"></span>
                                                            </div>
                                                            <div class="d-flex">
                                                                <div class="ps-3 text-wrap text-break">
                                                                    <h6 class="mb-1">Stewart Bond</h6>
                                                                    <p class="fs-13 mb-1">Your payment invoice is
                                                                        generated</p>
                                                                    <div class="small text-muted">
                                                                        3 days ago
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class=" text-center p-2">
                                                    <a href="chat.html" class="">See All Messages</a>
                                                </div>
                                            </div>
                                        </div> --}}
                                        {{-- <div class="dropdown header-notify">
                                            <a class="nav-link icon" data-bs-toggle="sidebar-right"
                                                data-bs-target=".sidebar-right">
                                                <i class="feather feather-bell header-icon"></i>
                                                <span class="bg-dot"></span>
                                            </a>
                                        </div> --}}
                                        <div class="dropdown profile-dropdown">
                                            <a href="#" class="nav-link pe-1 ps-0 leading-none"
                                                data-bs-toggle="dropdown">
                                                <span>
                                                    <img src="{!! asset('backend/images/users/16.jpg') !!}" alt="user-img"
                                                    class="avatar avatar-md bradius">
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
                <aside class="app-sidebar">
                    {{--            <div class="app-sidebar__logo"> --}}
                    {{--                <a class="header-brand" href="<?php echo url('/'); ?>"> --}}
                    {{--                    <img src="{!! asset('backend/images/brand/logo.png') !!}" class="header-brand-img desktop-lgo" alt=""> --}}
                    {{--                    <img src="{!! asset('backend/images/brand/logo-white.png') !!}" class="header-brand-img dark-logo" alt=""> --}}
                    {{--                    <img src="{!! asset('backend/images/brand/favicon.png') !!}" class="header-brand-img mobile-logo" alt=""> --}}
                    {{--                    <img src="{!! asset('backend/images/brand/favicon1.png') !!}" class="header-brand-img darkmobile-logo" alt=""> --}}
                    {{--                </a> --}}
                    {{--            </div> --}}
                    <div class="app-sidebar3" style="margin-top:0px;">
                        <div class="app-sidebar__user">
                            <div class="dropdown user-pro-body text-center">
                                <div>

                                    <img src="{{ asset('images/logo.png') }}" alt="user-img"
                                        class="avatar-xxl rounded-circle mb-1" style="object-fit: contain">

                                </div>
                                <div class="user-info">
                                    <h5 class=" mb-2">
                                        {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }} </h5>
                                    <span class="text-muted app-sidebar__user-name text-sm">
                                        {{ auth()->user()->email }} </span>
                                </div>
                            </div>
                        </div>
                        <ul class="side-menu">
                            <li class="side-item side-item-category mt-4">Menus</li>
                            @include('users.organization.menu')
                        </ul>
                    </div>
                </aside>
                <!--aside closed-->
            </div>
            <!--app-sidebar closed-->
            <div class="app-content main-content">
                <div class="side-app  main-container">

                    @if (session()->has('success'))
                        <div class="mt-4">
                            <x-bootstrap.alert.default message="{{ session()->get('success') }}"></x-bootstrap.alert.default>
                        </div>
                    @endif
                    {{ $slot }}

                </div>
            </div><!-- end app-content-->
        </div>
        <footer class="footer">
            <div class="container">
                <div class="row align-items-center flex-row-reverse">
                    <div class="col-md-12 col-sm-12 mt-3 mt-lg-0 text-center">
                        Copyright © 2023 <a href="#">{{ $website_name }}</a>. Developed by <a
                            href="https://devop360.com/" target="_blank">devop360</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Back to top -->
    <a href="#top" id="back-to-top"><span class="feather feather-chevrons-up"></span></a>
    <script type="text/javascript" src="{!! asset('backend/plugins/jquery/jquery.min.js') !!}"></script>
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
    <script type="text/javascript" src={!! asset('backend/plugins/summer-note/summernote1.js') !!}></script>
    <script type="text/javascript" src="{!! asset('backend/plugins/bootstrap-datepicker1/js/bootstrap-datepicker.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('backend/plugins/bootstrap-notify/bootstrap-notify.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('backend/js/jquery.validate.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('backend/js/jquery.form.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('backend/js/functions.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('backend/plugins/accordion/accordion.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('backend/plugins/chart/chart.bundle.js') !!}"></script>
    {{-- <script type="text/javascript" src="{{ asset('front/swigo/assets/vendor/bootstrap-touchspin/bootstrap-touchspin.js') }}"></script><!-- TOUCHSPIN --> --}}
    <script src="{{ asset('backend/plugins/jquery/block-ui.js') }}"></script>

    {{-- Toastify --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.min.js"
        integrity="sha512-79j1YQOJuI8mLseq9icSQKT6bLlLtWknKwj1OpJZMdPt2pFBry3vQTt+NZuJw7NSd1pHhZlu0s12Ngqfa371EA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function() {
            $("body").trigger("click");
        });
        $(document).on("click", "#playsound", function() {
            if (document.getElementById("myAudio").paused) {
                document.getElementById("myAudio").play()
            }
        })

        $("#file").change(function () {
            $('#import-data-form').submit();
        })

        $('#import-data-form').submit(function () {
            $('#import-data').attr('disabled', true);
            $('#import-data').html(
                `<span class="spinner-border" role="status"> <span
                    class="sr-only">Loading...</span>
                </span>`

            )
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
