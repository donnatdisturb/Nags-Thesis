<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>NAGS (Notify, Administer, General Publication and Scheduling)</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap 5 JS (popper is included in this bundle) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Your Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Favicon -->
    <link href="{{ asset('images/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&family=Roboto:wght@400;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">

    <!-- Customized Bootstrap Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        ul.navbar-nav.border-primary {
            border-color: #ffe468 !important;
        }
    </style>
    
</head>

<body>

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark shadow-sm px-5 py-3 py-lg-0"
        style="background-color: #2c1616 !important;">
        <div class="container">
            <a href="http://127.0.0.1:8000/" class="navbar-brand p-0">
                <h1 class="m-0 text-uppercase" style="color: #FFE468; font-family: Roboto Condensed, sans-serif; font-weight: bold;">
                    <img src="{{ asset('images/NAGSlogo.png') }}" alt="NAGS Logo"
                        style="margin-top: -.6rem;margin-right: .3rem;height: 40px">
                    NAGS
                </h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ms-auto py-0 pe-4 border-end border-5 border-primary">
                    <li class="nav-item"><a href="{{ URL::to('/') }}" class="nav-link active">Home</a></li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">About TUPT</a>
                        <div class="dropdown-menu m-0">
                            <a href="{{ URL::to('tup-mission-vision') }}" class="dropdown-item">Mission & Vision</a>
                            <a href="{{ URL::to('handbook') }}" class="dropdown-item">Student Handbook</a>
                            <a href="{{ URL::to('orgchart') }}" class="dropdown-item">Organizational Chart</a>
                        </div>
                    </li>
                    <li class="nav-item"><a href="{{ URL::to('announcements/announcement') }}" class="nav-link">Announcements</a></li>
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Dashboard</a>
                        </li>
                    @endguest
                </ul>
                <div class="d-none d-lg-flex align-items-center ps-4" style="color: #FFE468; font-family: Roboto Condensed, sans-serif; font-size: 1.5rem;">
                    <i class="fa fa-2x fa-mobile-alt text-secondary me-3"></i>
                    <div>
                        <h5 class="mb-1"><small>Contact us</small></h5>
                        <h6 class="text-light m-0">+123 4567 89</h6>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <h1 style="text-align: center; font-weight: 1000">ANNOUNCEMENTS</h1>
    @foreach ($announcements->chunk(3) as $announcementsChunk)
    <div class="row" style="padding: 30px;">
        @foreach ($announcementsChunk as $announcement)
        <div class="col-sm-6 col-md-4">
            <div class="card">
                <img src="{{ asset('/storage/images/' . $announcement->announcement_img) }}" class="card-img-top"
                    alt="Announcement Image">
                <div class="card-body">
                    <h3 class="card-title" style="font-weight: 1000; text-transform: uppercase;">
                        <span>{{ $announcement->title }}</span>
                    </h3>
                    <hr>
                    <h4 class="card-text"><span>{{ $announcement->content }}</span></h4>
                    <p class="m-0">Posted last:
                        {{ \Carbon\Carbon::createFromTimestamp(strtotime($announcement->created_at))->format('F d, Y |H:i:s') }}
                    </p>
                    <div class="clearfix">
                        <a href="{{ route('announcements.show', ['id' => $announcement->id]) }}"
                            class="btn btn-primary pull-right" role="button"><i class="fas fa-info"></i> Read
                            More</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endforeach

    <!-- Footer Start -->
    <div class="container-fluid bg-dark bg-footer text-light py-5" style="background-color: #2c1616 !important;">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <img src="{{ asset('images/NAGSLogo.png') }}" alt="NAGS Logo"
                        style="margin-top: -.6rem;margin-right: .3rem;height: 250px">
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 style="color: #FFE468; font-family: Roboto Condensed, sans-serif; font-weight: bold; font-size: 1.5rem;">Get In Touch</h4>
                    <hr class="w-25 text-secondary mb-4" style="opacity: 1;">
                    <p class="mb-4">All content is in the public domain unless otherwise stated.</p>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3" style="color: #ffe468"></i>KM. 14 East Service Road,
                        Taguig City Philippines</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3" style="color: #ffe468"></i>NAGS@tup.edu.ph</p>
                    <p class="mb-0"><i class="fa fa-phone-alt me-3" style="color: #ffe468"></i>+012 34567 89</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 style="color: #FFE468; font-family: Roboto Condensed, sans-serif; font-weight: bold; font-size: 1.5rem;">Quick Links</h4>
                    <hr class="w-25 text-secondary mb-4" style="opacity: 1;">
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-light mb-2" href="http://127.0.0.1:8000/"><i
                                class="fa fa-angle-right me-2"></i>Home</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>About Us</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Meet The
                            Team</a>
                        <a class="text-light" href="#"><i class="fa fa-angle-right me-2"></i>Contact Us</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 style="color: #FFE468; font-family: Roboto Condensed, sans-serif; font-weight: bold; font-size: 1.5rem;">Newsletter</h4>
                    <hr class="w-25 text-secondary mb-4" style="opacity: 1;">
                    <form action="">
                        <div class="input-group">
                            <input type="text" class="form-control p-3 border-0" placeholder="Your Email">
                            <button class="btn btn-primary" style="color: black; background-color:#ffe468; border-color: #ffe468">Sign Up</button>
                        </div>
                    </form>
                    <h6 style="color: #FFE468; font-family: Roboto Condensed, sans-serif; font-weight: bold; font-size: 16px; margin-top: 10px; margin-bottom: 10px;">Follow Us</h6>
                    <div class="d-flex">
                        <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" href="#" style="color: black; background-color:#ffe468; border-color: #ffe468"><i
                                class="fab fa-twitter"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" style="color: black; background-color:#ffe468; border-color: #ffe468"
                            href="https://www.facebook.com/TUPTGuidance"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" href="#" style="color: black; background-color:#ffe468; border-color: #ffe468"><i
                                class="fab fa-linkedin-in"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square rounded-circle" href="#" style="color: black; background-color:#ffe468; border-color: #ffe468"><i
                                class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-primary text-dark py-4" style="background-color: #C5675B !important">
        <div class="container">
            <div class="row g-0">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-md-0">Copyright &copy; <a class="text-dark fw-bold"
                            href="http://127.0.0.1:8000/">NAGS</a>. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-secondary btn-lg-square rounded-circle back-to-top"
        style="background-color: #FFE468;"><i class="bi bi-arrow-up"></i></a>

    <!-- Libraries JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>