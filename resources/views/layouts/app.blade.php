<!DOCTYPE html>
<html lang="en">

<style>
    #logo {
        display: inline-block;
        /* margin: 5px; margin: 20px was off */
        margin-right: 5px;
        float: left;
        height: 30px;
        width: 30px;
        /* correct proportions to specified height */
        border-radius: 50%;
        /* makes it a circle */
    }
</style>

<script type="text/javascript">
    function showTime() {


        var date = new Date();
        var utcDate = new Date(date.toUTCString());
        utcDate.setHours(utcDate.getHours() + 8);
        var usDate = new Date(utcDate);
        // console.log(usDate);
        document.getElementById('time').innerHTML = usDate.toUTCString();

    }

    setInterval(showTime, 1000);
</script>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'PASSway') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.9.0/main.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.9.0/main.min.js"></script>
    

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    @yield('styles')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>
            <div style="text-align:center; color: white; margin-right: 5px;"><strong>Today is </strong></div>
            <div id="time" style="text-align:center; color: white; font-weight: 1000;"></div>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                {{-- {{\Carbon\Carbon::now()->format('d-m-Y')}} --}}
                <li class="nav-item dropdown">
                    {{-- {{\Carbon\Carbon::now()->format('d-m-Y')}} --}}
                    @if (Auth::check())
                        @if (auth()->user()->role === 'guidance')
                            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                                <img id="logo"
                                    src="{{ asset('/storage/images/' .\App\Models\Guidance::where(['user_id' => Auth::user()->id])->pluck('guidance_img')->first()) }}">
                                {{ \App\Models\Guidance::where(['user_id' => Auth::user()->id])->pluck('lname')->first() }},{{ \App\Models\Guidance::where(['user_id' => Auth::user()->id])->pluck('fname')->first() }}
                                {{-- <p>{{ Auth::user()->role }}</p> --}}
                            </a>
                        @elseif(auth()->user()->role === 'student')
                            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                                <img id="logo"
                                    src="{{ asset('/storage/images/' .\App\Models\Student::where(['user_id' => Auth::user()->id])->pluck('student_img')->first()) }}">
                                {{ \App\Models\Student::where(['user_id' => Auth::user()->id])->pluck('lname')->first() }},{{ \App\Models\Student::where(['user_id' => Auth::user()->id])->pluck('fname')->first() }}
                                {{-- <p>{{ Auth::user()->role }}</p> --}}
                            </a>
                        @endif
                    @endif

                    <div class="dropdown-menu dropdown-menu-right" style="left: inherit; right: 0px;">
                        @if (Auth::check())
                            @if (auth()->user()->role === 'guidance')
                                <a href="{{ route('guidance.profile') }}" " class="dropdown-item"><i class="mr-2 fas fa-file"></i>
                                {{ __('My profile') }}</a>
@elseif(auth()->user()->role === 'student')
<a href="{{ route('studentprofile') }}" " class="dropdown-item"><i class="mr-2 fas fa-file"></i>
                                    {{ __('My profile') }}</a>
                            @endif
                        @endif

                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" class="dropdown-item"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="mr-2 fas fa-sign-out-alt"></i>
                                {{ __('Log Out') }}
                            </a>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/" class="brand-link">
                <img src="{{ asset('images/PASSwayLogo.png') }}" alt="PASSway Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-bold">PASSway</span>
            </a>

            @include('layouts.navigation')
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->


    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    @vite('resources/js/app.js')
    <!-- AdminLTE App -->
    <script src="{{ asset('js/adminlte.min.js') }}" defer></script>

    @yield('scripts')
    @stack('scripts')

</body>

</html>
