<!DOCTYPE html>
<html>
<head>
    <title>PASSway</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
    <script src="https://kit.fontawesome.com/c88097f817.js" crossorigin="anonymous"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script> --}}
    {{-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet"> --}}

    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> --}}

        
    {{-- {!! Charts::assets() !!} --}}

</head>
<body>
    <nav class="navbar navbar-light navbar-expand-lg mb-5" style="background-color: #e3f2fd;">
        <div class="container">
            <a class="navbar-brand mr-auto" href="#">PASSway</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    @else
                     @if (Auth::check())
                     @if (auth()->user()->role === 'guidance')
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="{{ route('studentindex') }}">Student Index</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('guidanceindex') }}">Guidance Index</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('studentrecordindex') }}">Student Records</a>
                    </li>
        
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('indexrecord') }}">Top Violators</a>
                    </li> --}}
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('topviolator') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('signout') }}">Logout</a>
                    </li>


                   @elseif(auth()->user()->role === 'student')
                    
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="{{ route('studentdashboard') }}">View My Records</a>
                    </li> --}}
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                          {{-- <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                              <i class="fa fa-user" aria-hidden="true"></i> {{ Auth::user()->role }}
                             </a>

                                <ul class="dropdown-menu">
                                  <li><a href="{{ route('studentdashboard') }}">Dashboard</li>
                                  <li role="separator" class="divider"></li>
                                  <li><a href="{{ route('signout') }}">Logout</a></li>
                                </ul>
                          </li> --}}

                          <li class="nav-item">
                            <a class="nav-link" href="{{ route('studentdashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('studentprofile') }}">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('signout') }}">Logout</a>
                        </li>
    
                        </ul>
                    </div>
                    
                    @endif
                 
                    @endif
                    @endguest
                    
                   
                </ul>
            </div>
        </div>
    </nav>
    {{-- @yield('content') --}}
</body>
</html>
