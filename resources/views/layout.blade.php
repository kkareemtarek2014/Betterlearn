<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">


  <meta content="" name="description">
  <meta content="" name="keywords">
  <script src="https://kit.fontawesome.com/8911db563d.js" crossorigin="anonymous"></script>


  <!-- Favicons -->
  <link href="{{asset("assets\img\trainers\pexels-artem-beliaikin-1079033.jpg")}}" rel="icon">
  <link href="{{asset("assets\img\trainers\pexels-artem-beliaikin-1079033.jpg")}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset("assets/vendor/animate.css/animate.min.css")}}" rel="stylesheet">
  <link href="{{asset("assets/vendor/aos/aos.css")}}" rel="stylesheet">
  <link href="{{asset("assets/vendor/bootstrap/css/bootstrap.min.css")}}" rel="stylesheet">
  <link href="{{asset("assets/vendor/bootstrap-icons/bootstrap-icons.css")}}" rel="stylesheet">
  <link href="{{asset("assets/vendor/boxicons/css/boxicons.min.css")}}" rel="stylesheet">
  <link href="{{asset("assets/vendor/remixicon/remixicon.css")}}" rel="stylesheet">
  <link href="{{asset("assets/vendor/swiper/swiper-bundle.min.css")}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset("assets/css/style.css")}}" rel="stylesheet">


</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="{{route('home')}}">BetterLearn</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="active" href="{{route('home')}}">Home</a></li>
          <li><a href="{{route('aboutus')}}">About</a></li>
          <li><a href="{{route('courses')}}">Courses</a></li>

          <li><a href="{{route('contactus')}}">Contact</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
        <form action="{{route('cart')}}" class="font-size-14 font-raleway">
          <a href="{{route('cart')}}" class="py- rounded-pill">
            <span class="font-size-50 px-lg-1 size">
              <i class="fas fa-shopping-cart"></i></span>
            <span class="px-3 py-2 rounded-pill text-dar bg-light">{{Cart::getContent()->count()}}</span>
          </a>
        </form>
      </nav><!-- .navbar -->

      <a href="{{route('courses')}}" class="get-started-btn">Get Started</a>

    </div>
  </header><!-- End Header -->

  @yield('content')

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>BetterLearn</h3>
            <p>
              A108 Adam Street <br>
              Cairo<br>
              Egypt <br><br>
              <strong>Phone:</strong> 01111111111<br>
              <strong>Email:</strong> info@example.com<br>
            </p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="{{route('home')}}">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{route('aboutus')}}">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{route('courses')}}">Courses</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{route('contactus')}}">Contactus</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{route('cart')}}">Cart</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="{{route('courses')}}">Web Design</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{route('courses')}}">Web Development</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{route('courses')}}">Product Management</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{route('courses')}}">Marketing</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{route('courses')}}">Graphic Design</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-2 footer-newsletter">

            <img src="assets\img\—Pngtree—egypt flag transparent watercolor painted_5326754.png" class="img-fluid" alt="">
          </div>

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">

        <div class="credits">

        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset("assets/vendor/aos/aos.js")}}"></script>
  <script src="{{asset("assets/vendor/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
  <script src="{{asset("assets/vendor/php-email-form/validate.js")}}" ></script>
  <script src="{{asset("assets/vendor/purecounter/purecounter.js")}}"></script>
  <script src="{{asset("assets/vendor/swiper/swiper-bundle.min.js")}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset("assets/js/main.js")}}"></script>

  <!-- isotope plugin cdn -->
  <script src="  https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js"></script>


</body>

</html>
