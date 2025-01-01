<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('/img/finku_icon.png')}}">
    <link rel="icon" type="image/png" href="{{asset('/img/finku_icon.png')}}">
    <title>
        Pembukuan Keuangan
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/nucleo-icons/css/nucleo.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css') }}" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        /* Efek hover pada card */
        .card-hover {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out; /* Gabungkan kedua transisi */
        }

        .card-hover:hover {
            transform: translateY(-4px); 
            /* box-shadow: 0 0 2rem 0 rgba(136, 152, 170, 0.15); */
            /* box-shadow: 0 0 2rem 0 rgba(136, 152, 170, 0.3); */
            box-shadow: 0 4px 2rem rgba(136, 152, 170, 0.3);
        }

        /* Efek hover pada button */
        .btn-hover {
            transition: background-color 0.3s ease-in-out;
        }
        .btn-hover:hover {
            background-color: #4e60e7; 
        }

        .href-hover {
            display: inline-block; 
            padding: 0px; 
            transition: transform 0.15s ease-in-out;
        }
        .href-hover:hover {
            transform: scale(1.05);
        }

        .tr-hover{
            transition: background-color 0.3s ease-in-out;
        }

        .tr-hover:hover {
            background-color: #F6F9FC; 
        }

        /* .nav-hover {
            transition: background-color 0.3s ease, transform 0.3s ease; 
        }

        .nav-hover:hover {
            background-color: #F6F9FC; 
            transform: translateX(4px);
        } */
        
        
    </style>
</head>

<body class="{{ $class ?? '' }}">

    @guest
        @yield('content')
    @endguest

    @auth
        @if (in_array(request()->route()->getName(), ['sign-in-static', 'sign-up-static', 'login', 'register', 'recover-password', 'rtl', 'virtual-reality']))
            @yield('content')
        @else
            {{-- @if (!in_array(request()->route()->getName(), ['profile', 'profile-static']))
                <div class="min-height-300 bg-primary position-absolute w-100"></div>
            @elseif (in_array(request()->route()->getName(), ['profile-static', 'profile'])) --}}
                <div class="position-absolute w-100 min-height-300 top-0" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/profile-layout-header.jpg'); background-position-y: 50%;">
                    <span class="mask bg-primary opacity-6"></span>
                </div>
            {{-- @endif --}}
            @include('../layouts.navbars.auth.sidenav')
                <main class="main-content border-radius-lg">
                    @yield('content')
                </main>
        @endif
    @endauth

    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('assets/js/argon-dashboard.js') }}"></script>
    @stack('js');
</body>

</html>
