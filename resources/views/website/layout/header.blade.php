<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Bright Star Website</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ asset('website/img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('website/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('website/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('website/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('website/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h2 class="m-0 text-primary"><i class="fa fa-book me-3"></i>Bright Star</h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="{{ route('website') }}" class="nav-item nav-link">Home</a>
                <a href="{{ route('about_page') }}" class="nav-item nav-link">About</a>
                <a href="{{ route('courses_page') }}" class="nav-item nav-link">Courses</a>
                <a href="{{ route('tistimonials_page') }}" class="nav-item nav-link">Testimonial</a>
                <a href="{{ route('contact_page') }}" class="nav-item nav-link">Contact</a>
                {{-- اگر login نشده باشد --}}
                @guest
                    <a href="{{ route('login') }}" class="nav-item nav-link active fw-bold">
                        Login
                    </a>
                @endguest

                {{-- اگر login شده باشد --}}
                @auth
                    <a href="{{ route('dashboard') }}" class="nav-item nav-link active fw-bold">
                        Dashboard
                    </a>
                @endauth
            </div>
        </div>
    </nav>
    <div class="container-fluid p-0 mb-5" style="margin-top: -15px;">
        <div class="owl-carousel header-carousel position-relative">
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="{{ asset('website/img/course-2.jpg') }}" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                    style="background: rgba(24, 29, 56, .7);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-sm-10 col-lg-8">
                                <h5 class="text-primary text-uppercase mb-3 animated slideInDown">Best Courses
                                    <br>
                                </h5>
                                <h1 class="display-3 text-white animated slideInDown">The Best Learning Platform
                                </h1>
                                <br>
                                <p class="fs-5 text-white mb-4 pb-2">Vero elitr justo clita lorem. Ipsum dolor at sed
                                    stet sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum sea sanctus
                                    eirmod elitr.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
