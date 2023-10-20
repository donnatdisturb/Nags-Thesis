<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        {{-- <meta charset="utf-8">
            <title>PASSway - A Digitalized Management System for Student Violation Record</title> --}}
            <meta content="width=device-width, initial-scale=1.0" name="viewport">
            <meta content="Free HTML Templates" name="keywords">
            <meta content="Free HTML Templates" name="description">
        
            <!-- Favicon -->
            <link href="images/favicon.ico" rel="icon">
        
            <!-- Google Web Fonts -->
            <link rel="preconnect" href="https://fonts.gstatic.com">
            <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">  
        
            <!-- Icon Font Stylesheet -->
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
        
            <!-- Libraries Stylesheet -->
            <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        
            <!-- Customized Bootstrap Stylesheet -->
            <link href="css/bootstrap.min.css" rel="stylesheet">
        
            <!-- Template Stylesheet -->
            <link href="css/style.css" rel="stylesheet">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ url('src/css/app.css')}}">
        @yield('styles')
    </head>
    <body>
        @include('partials.header')
        <!-- Navbar Start -->
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark shadow-sm px-5 py-3 py-lg-0">
            <a href="http://127.0.0.1:8000/" class="navbar-brand p-0">
                <h1 class="m-0 text-uppercase text-primary">
                    {{-- <i class="fa fa-ticket text-secondary me-3"></i> --}}
                    <img src="{{ asset('images/PASSwayLogo.png') }}" alt="PASSway Logo" style="margin-top: -.6rem;margin-right: .3rem;height: 40px">
                    PASSway</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0 pe-4 border-end border-5 border-primary">
                    <a href="{{URL::to('/')}}" class="nav-item nav-link active">Home</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">About TUPT</a>
                        <div class="dropdown-menu m-0">
                            <a href="{{URL::to('tup-mission-vision')}}" class="dropdown-item">Mission & Vision</a>
                            <a href="{{URL::to('handbook')}}" class="dropdown-item">Student Handbook</a>
                            <a href="{{URL::to('orgchart')}}" class="dropdown-item">Organizational Chart</a>
                            {{-- <a href="testimonial.html" class="dropdown-item">Testimonial</a> --}}
                        </div>
                    </div>
                    <a href="{{ route('login')  }}" class="nav-item nav-link">Login</a>
                    {{-- <a href="contact.html" class="nav-item nav-link">Contact</a>          --}}
                </div>
                <div class="d-none d-lg-flex align-items-center ps-4">
                    <i class="fa fa-2x fa-mobile-alt text-secondary me-3"></i>
                    <div>
                        <h5 class="text-primary mb-1"><small>Contact us</small></h5>
                        <h6 class="text-light m-0">+123 4567 89</h6>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Navbar End -->
    @include('partials.header')
    <div class="container">
        @yield('content')
    </div>


    <script
      src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
    @yield('scripts')
    {{-- </body> --}}

        <!-- Footer Start -->
        <div class="container-fluid bg-dark bg-footer text-light py-5">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <img src="{{ asset('images/PASSwayLogo.png') }}" alt="PASSway Logo" style="margin-top: -.6rem;margin-right: .3rem;height: 250px">
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4 class="text-primary">Get In Touch</h4>
                        <hr class="w-25 text-secondary mb-4" style="opacity: 1;">
                        <p class="mb-4">All content is in the public domain unless otherwise stated.</p>
                        <p class="mb-2"><i class="fa fa-map-marker-alt text-primary me-3"></i>KM. 14 East Service Road, Taguig City Philippines</p>
                        <p class="mb-2"><i class="fa fa-envelope text-primary me-3"></i>passway@tup.edu.ph</p>
                        <p class="mb-0"><i class="fa fa-phone-alt text-primary me-3"></i>+012 34567 89</p>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4 class="text-primary">Quick Links</h4>
                        <hr class="w-25 text-secondary mb-4" style="opacity: 1;">
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-light mb-2" href="http://127.0.0.1:8000/"><i class="fa fa-angle-right me-2"></i>Home</a>
                            <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>About Us</a>
                            <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Meet The Team</a>
                            <a class="text-light" href="#"><i class="fa fa-angle-right me-2"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4 class="text-primary">Newsletter</h4>
                        <hr class="w-25 text-secondary mb-4" style="opacity: 1;">
                        <form action="">
                            <div class="input-group">
                                <input type="text" class="form-control p-3 border-0" placeholder="Your Email">
                                <button class="btn btn-primary">Sign Up</button>
                            </div>
                        </form>
                        <h6 class="text-primary mt-4 mb-3">Follow Us</h6>
                        <div class="d-flex">
                            <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" href="https://www.facebook.com/TUPTGuidance"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-lg btn-primary btn-lg-square rounded-circle" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid bg-primary text-dark py-4">
            <div class="container">
                <div class="row g-0">
                    <div class="col-md-6 text-center text-md-start">
                        <p class="mb-md-0">Copyright &copy; <a class="text-dark fw-bold" href="http://127.0.0.1:8000/">PASSway</a>. All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-secondary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>

        <!-- Template Javascript -->
        <script src="js/main.js"></script>

        <script
        src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
        @yield('scripts')
    </body>
</html>