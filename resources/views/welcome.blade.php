<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>NAGS (Notify, Administer, General Publication and Scheduling)</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="images/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&family=Roboto:wght@400;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    {{-- <div class="container-fluid bg-primary d-none d-lg-block">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-lg-start mb-2 mb-lg-0">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-dark py-2 pe-3 border-end border-white" href=""><i class="bi bi-telephone text-secondary me-2"></i>+012 345 6789</a>
                        <a class="text-dark py-2 px-3" href=""><i class="bi bi-envelope text-secondary me-2"></i>info@example.com</a>
                    </div>
                </div>
                <div class="col-md-6 text-center text-lg-end">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-body py-2 px-3 border-end border-white" href="">
                            <i class="fab fa-facebook-f text-secondary"></i>
                        </a>
                        <a class="text-body py-2 px-3 border-end border-white" href="">
                            <i class="fab fa-twitter text-secondary"></i>
                        </a>
                        <a class="text-body py-2 px-3 border-end border-white" href="">
                            <i class="fab fa-linkedin-in text-secondary"></i>
                        </a>
                        <a class="text-body py-2 px-3 border-end border-white" href="">
                            <i class="fab fa-instagram text-secondary"></i>
                        </a>
                        <a class="text-body py-2 ps-3" href="">
                            <i class="fab fa-youtube text-secondary"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark shadow-sm px-5 py-3 py-lg-0">
        <a href="http://127.0.0.1:8000/" class="navbar-brand p-0">
            <h1 class="m-0 text-uppercase text-primary">
                {{-- <i class="fa fa-ticket text-secondary me-3"></i> --}}
                <img src="{{ asset('images/NAGSLogo.png') }}" alt="NAGS Logo"
                    style="margin-top: -.6rem;margin-right: .3rem;height: 40px">
                    NAGS
            </h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0 pe-4 border-end border-5 border-primary">
                <a href="{{ URL::to('/') }}" class="nav-item nav-link active">Home</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">About MBHS</a>
                    <div class="dropdown-menu m-0">
                        <a href="{{ URL::to('tup-mission-vision') }}" class="dropdown-item">Mission & Vision</a>
                        <a href="{{ URL::to('handbook') }}" class="dropdown-item">Student Handbook</a>
                        <a href="{{ URL::to('orgchart') }}" class="dropdown-item">Organizational Chart</a>
                        {{-- <a href="testimonial.html" class="dropdown-item">Testimonial</a> --}}
                    </div>
                </div>
                <a href="{{ URL::to('announcements/announcement') }}" class="nav-item nav-link">Announcements</a>
                {{-- <a href="{{URL::to('announcement-page')}}" class="dropdown-item">Announcements</a> --}}

                {{-- <a href="{{ route('login')  }}" class="nav-item nav-link">Login</a> --}}
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Profile</a>
                    </li>

                @endguest
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


    <!-- Hero Start -->
    <div class="container-fluid bg-primary py-5 bg-hero" style="margin-bottom: 90px;">
        <div class="container py-5">
            <div class="row justify-content-start">
                <div class="col-lg-8 text-center text-lg-start">
                    <h4 class="display-1 text-dark">A Digitalized Guidance Management System of Muntinlupa Business High School</h4>
                    <p class="fs-4 text-dark mb-4">A system that aims to help the school, specifically the guidance office, manage and easily facilitate the records of the students and the guidance office.</p>
                    <div class="pt-2">
                        <a href="" class="btn btn-secondary rounded-pill py-md-3 px-md-5 mx-2">Get A Quote</a>
                        {{-- <a href="" class="btn btn-outline-secondary rounded-pill py-md-3 px-md-5 mx-2">Contact Us</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row gx-0 mb-3 mb-lg-0">
                <div class="col-lg-6 my-lg-5 py-lg-5">
                    <div class="about-start bg-primary p-5">
                        <h1 class="display-5 mb-4">SVNHS STEM Students Work Immersion</h1>
                        <p>Tempor erat elitr at rebum at at clita. Diam dolor diam ipsum et, tempor sit sit diam amet et
                            eos labore. Clita erat ipsum et lorem et sit, sed stet no labore lorem sit. Sanctus clita
                            duo justo et tempor magna dolore erat amet </p>
                        <a href="{{ URL::to('immersion') }}"
                            class="btn btn-secondary rounded-pill py-md-3 px-md-5 mt-4">Read More</a>
                    </div>
                </div>
                <div class="col-lg-6" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100" src="images/Immersion.jpg"
                            style="object-fit: cover;">
                    </div>
                </div>
            </div>
            <div class="row gx-0">
                <div class="col-lg-6" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100" src="images/Graduation.jpg"
                            style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 my-lg-5 py-lg-5">
                    <div class="about-end bg-primary p-5">
                        <h1 class="display-5 mb-4">43rd Commencement Exercise</h1>
                        <p>The 43rd Commencement Exercises, with a theme, TUP@45: "KAMI SA IYO AY NAGPUPUGAY" of the
                            Technological University of the Philippines - Taguig was held yesterday, January 21st, at
                            the Philippine International Convention Center (PICC) Plenary Hall. </p>
                        <a href="{{ URL::to('graduation') }}"
                            class="btn btn-secondary rounded-pill py-md-3 px-md-5 mt-4">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Testimonial Start -->
    <div class="container-fluid bg-primary bg-testimonial py-5" style="margin: 90px 0;">
        <div class="container py-5">
            <div class="row g-0 justify-content-end">
                <div class="col-lg-6">
                    <h1 class="display-5 mb-4">OTHER ANNOUNCEMENTS</h1>
                    <div class="owl-carousel testimonial-carousel">
                        @foreach ($announcements as $announcement)
                            <div class="testimonial-item">
                                <p class="fs-4 fw-normal"><i
                                        class="fa fa-quote-left text-secondary me-3"></i>{{ $announcement->title }}
                                </p>
                                <a href="{{ route('announcements.show', ['id' => $announcement->id]) }}"
                                    class="btn btn-secondary rounded-pill py-md-3 px-md-5 mx-2">View
                                    Announcement</a><br><br>
                                <div class="d-flex align-items-center">
                                    <img class="img-fluid p-1 bg-secondary"
                                        src="{{ asset('/storage/images/' . $announcement->guidanceIMG) }}"
                                        alt="">
                                    <div class="ps-3">
                                        <h3>{{ $announcement->lname . ', ' . $announcement->fname }}</h3>
                                        <span class="text-uppercase">Guidance Counselor</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        {{-- <div class="testimonial-item">
                            <p class="fs-4 fw-normal"><i class="fa fa-quote-left text-secondary me-3"></i>Dolores sed duo clita tempor justo dolor et stet lorem kasd labore dolore lorem ipsum. At lorem lorem magna ut et, nonumy et labore et tempor diam tempor erat dolor rebum sit ipsum.</p>
                            <a href="" class="btn btn-secondary rounded-pill py-md-3 px-md-5 mx-2">View Announcement</a><br><br>
                            <div class="d-flex align-items-center">
                                <img class="img-fluid p-1 bg-secondary" src="images/testimonial-2.jpg" alt="">
                                <div class="ps-3">
                                    <h3>Client Name</h3>
                                    <span class="text-uppercase">Profession</span>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->

    <!-- Team Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5" style="max-width: 500px;">
                <h1 class="display-5">Dedicated Team Members</h1>
                <hr class="w-25 mx-auto text-primary" style="opacity: 1;">
            </div>
            <div class="row g-3">
                <div class="col-lg-3 col-md-3">
                    <div class="team-item">
                        <img class="img-fluid w-100" src="images/Ganiron.jpeg" alt="Nathaniel Ganiron">
                        <div class="team-text">
                            <div class="team-social">
                                <a class="btn btn-lg btn-secondary btn-lg-square rounded-circle me-2"
                                    href="https://www.instagram.com/imnathgani/"><i class="fab fa-instagram"></i></a>
                                <a class="btn btn-lg btn-secondary btn-lg-square rounded-circle me-2"
                                    href="https://www.facebook.com/nathaniel.ganiron.7"><i
                                        class="fab fa-facebook-f"></i></a>
                            </div>
                            <div class="mt-auto mb-3" style="text-align:center;">
                                <h4 class="mb-1" style="color: #ffe468;">Nathaniel Ganiron</h4>
                                <span class="text-uppercase" style="color: #FCFFE7;">NAGS Developer</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3">
                    <div class="team-item">
                        <img class="img-fluid w-100" src="images/Santiago.jpg" alt="Shadonna Santiago">
                        <div class="team-text" style="text-alignment:center;">
                            <div class="team-social">
                                <a class="btn btn-lg btn-secondary btn-lg-square rounded-circle me-2"
                                    href="https://www.instagram.com/luvss4donna/"><i class="fab fa-instagram"></i></a>
                                <a class="btn btn-lg btn-secondary btn-lg-square rounded-circle me-2"
                                    href="https://www.facebook.com/aoi.kiriya.31"><i
                                        class="fab fa-facebook-f"></i></a>
                            </div>
                            <div class="mt-auto mb-3" style="text-align:center;">
                                <h4 class="mb-1" style="color: #ffe468;">Shadonna Santiago</h4>
                                <span class="text-uppercase" style="color: #FCFFE7;">NAGS Developer</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3">
                    <div class="team-item">
                        <img class="img-fluid w-100" src="images/Geroza.jpg" alt="Abigail Geroza">
                        <div class="team-text">
                            <div class="team-social">
                                <a class="btn btn-lg btn-secondary btn-lg-square rounded-circle me-2"
                                    href="https://www.instagram.com/liagibbaa/"><i class="fab fa-instagram"></i></a>
                                <a class="btn btn-lg btn-secondary btn-lg-square rounded-circle me-2"
                                    href="https://www.facebook.com/abigail.geroza"><i
                                        class="fab fa-facebook-f"></i></a>
                            </div>
                            <div class="mt-auto mb-3" style="text-align:center;">
                                <h4 class="mb-1" style="color: #ffe468;">Abigail Geroza</h4>
                                <span class="text-uppercase" style="color: #FCFFE7;">NAGS Developer</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3">
                    <div class="team-item">
                        <img class="img-fluid w-100" src="images/Geroza.jpg" alt="Dexter Jay Cancino">
                        <div class="team-text">
                            <div class="team-social">
                                <a class="btn btn-lg btn-secondary btn-lg-square rounded-circle me-2"
                                    href="https://www.instagram.com/djaydxtr/"><i class="fab fa-instagram"></i></a>
                                <a class="btn btn-lg btn-secondary btn-lg-square rounded-circle me-2"
                                    href="https://www.facebook.com/djay.cancino"><i
                                        class="fab fa-facebook-f"></i></a>
                            </div>
                            <div class="mt-auto mb-3" style="text-align:center;">
                                <h4 class="mb-1" style="color: #ffe468;">Dexter Jay Cancino</h4>
                                <span class="text-uppercase" style="color: #FCFFE7;">NAGS Developer</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->

    {{-- <!-- Quote Start -->
    <div class="container-fluid bg-primary bg-quote py-5" style="margin: 90px 0;">
        <div class="container py-5">
            <div class="row g-0 justify-content-start">
                <div class="col-lg-6">
                    <div class="bg-white text-center p-5">
                        <h1 class="mb-4">Get A Quote</h1>
                        <form>
                            <div class="row g-3">
                                <div class="col-12 col-sm-6">
                                    <input type="text" class="form-control bg-light border-0" placeholder="Your Name" style="height: 55px;">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="email" class="form-control bg-light border-0" placeholder="Your Email" style="height: 55px;">
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control bg-light border-0 py-3" rows="2" placeholder="Message"></textarea>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">Get A Quote</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Quote End -->


    <!-- Blog Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5" style="max-width: 500px;">
                <h1 class="display-5">Latest Articles From Painting Blog</h1>
                <hr class="w-25 mx-auto text-primary" style="opacity: 1;">
            </div>
            <div class="row g-3">
                <div class="col-xl-4 col-lg-6">
                    <div class="blog-item bg-primary">
                        <img class="img-fluid w-100" src="images/blog-1.jpg" alt="">
                        <div class="d-flex align-items-center">
                            <div class="bg-secondary mt-n4 d-flex flex-column flex-shrink-0 justify-content-center text-center me-4" style="width: 60px; height: 100px;">
                                <i class="fa fa-calendar-alt text-primary mb-2"></i>
                                <p class="m-0 text-white">Jan 01</p>
                                <small class="text-white">2045</small>
                            </div>
                            <a class="h4 m-0 text-truncate me-4" href="">Dolor clita vero elitr sea stet dolor justo  diam</a>
                        </div>
                        <div class="d-flex justify-content-between border-top border-secondary p-4">
                            <div class="d-flex align-items-center">
                                <img class="rounded-circle me-2" src="images/user.jpg" width="30" height="30" alt="">
                                <small class="text-uppercase">John Doe</small>
                            </div>
                            <div class="d-flex align-items-center">
                                <small class="ms-3"><i class="fa fa-eye text-secondary me-2"></i>12345</small>
                                <small class="ms-3"><i class="fa fa-comment text-secondary me-2"></i>123</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6">
                    <div class="blog-item bg-primary">
                        <img class="img-fluid w-100" src="images/blog-2.jpg" alt="">
                        <div class="d-flex align-items-center">
                            <div class="bg-secondary mt-n4 d-flex flex-column flex-shrink-0 justify-content-center text-center me-4" style="width: 60px; height: 100px;">
                                <i class="fa fa-calendar-alt text-primary mb-2"></i>
                                <p class="m-0 text-white">Jan 01</p>
                                <small class="text-white">2045</small>
                            </div>
                            <a class="h4 m-0 text-truncate me-4" href="">Dolor clita vero elitr sea stet dolor justo  diam</a>
                        </div>
                        <div class="d-flex justify-content-between border-top border-secondary p-4">
                            <div class="d-flex align-items-center">
                                <img class="rounded-circle me-2" src="images/user.jpg" width="30" height="30" alt="">
                                <small class="text-uppercase">John Doe</small>
                            </div>
                            <div class="d-flex align-items-center">
                                <small class="ms-3"><i class="fa fa-eye text-secondary me-2"></i>12345</small>
                                <small class="ms-3"><i class="fa fa-comment text-secondary me-2"></i>123</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6">
                    <div class="blog-item bg-primary">
                        <img class="img-fluid w-100" src="images/blog-3.jpg" alt="">
                        <div class="d-flex align-items-center">
                            <div class="bg-secondary mt-n4 d-flex flex-column flex-shrink-0 justify-content-center text-center me-4" style="width: 60px; height: 100px;">
                                <i class="fa fa-calendar-alt text-primary mb-2"></i>
                                <p class="m-0 text-white">Jan 01</p>
                                <small class="text-white">2045</small>
                            </div>
                            <a class="h4 m-0 text-truncate me-4" href="">Dolor clita vero elitr sea stet dolor justo  diam</a>
                        </div>
                        <div class="d-flex justify-content-between border-top border-secondary p-4">
                            <div class="d-flex align-items-center">
                                <img class="rounded-circle me-2" src="images/user.jpg" width="30" height="30" alt="">
                                <small class="text-uppercase">John Doe</small>
                            </div>
                            <div class="d-flex align-items-center">
                                <small class="ms-3"><i class="fa fa-eye text-secondary me-2"></i>12345</small>
                                <small class="ms-3"><i class="fa fa-comment text-secondary me-2"></i>123</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog End --> --}}


    <!-- Footer Start -->
    <div class="container-fluid bg-dark bg-footer text-light py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <img src="{{ asset('images/NAGSLogo.png') }}" alt="NAGS Logo"
                        style="margin-top: -.6rem;margin-right: .3rem;height: 250px">
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-primary">Get In Touch</h4>
                    <hr class="w-25 text-secondary mb-4" style="opacity: 1;">
                    <p class="mb-4">All content is in the public domain unless otherwise stated.</p>
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary me-3"></i>KM. 14 East Service Road,
                        Taguig City Philippines</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary me-3"></i>NAGS@tup.edu.ph</p>
                    <p class="mb-0"><i class="fa fa-phone-alt text-primary me-3"></i>+012 34567 89</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-primary">Quick Links</h4>
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
                        <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" href="#"><i
                                class="fab fa-twitter"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2"
                            href="https://www.facebook.com/TUPTGuidance"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" href="#"><i
                                class="fab fa-linkedin-in"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square rounded-circle" href="#"><i
                                class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-primary text-dark py-4">
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
    <a href="#" class="btn btn-lg btn-secondary btn-lg-square rounded-circle back-to-top"><i
            class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
