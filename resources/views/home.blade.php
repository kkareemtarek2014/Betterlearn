@extends('layout')
@section('content')

<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex justify-content-center align-items-center">
    <div class="container position-relative" data-aos="zoom-in" data-aos-delay="100">
      <h1>Learning Today,<br>Leading Tomorrow</h1>
      <h2></h2>
      <a href="{{route('courses')}}" class="btn-get-started">Get Started</a>
    </div>
  </section><!-- End Hero -->

  <!-- ================================================================= -->
  <section id="about" class="about">
    <div class="container" data-aos="fade-up">

      <div class="row">
        <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
          <img src="assets\img\trainers\pexels-startup-stock-photos-7095.jpg" class="img-fluid" alt="">
        </div>
        <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
          <h3>In total, it was a big success, I would get emails about what a fantastic resource it was.</h3>
          <p class="fst-italic">
          responds to the needs of the business in an agile and global manner. It’s truly the best solution for our employees and their careers.
          </p>
          <ul>
            <li><i class="bi bi-check-circle"></i>  we’re all learners and instructors. We live out our values every day to create a culture that is diverse, inclusive, and committed to helping employees thrive.</li>
            <li><i class="bi bi-check-circle"></i> We’re committed to changing the future of learning for the better.</li>
            <li><i class="bi bi-check-circle"></i> Want to know what we’ve been up to lately? Check out the Udemy blog to get the scoop on the latest news, ideas and projects, and more.</li>
          </ul>
          <p>
          Their team curates fresh, up-to-date courses from their marketplace and makes them available to customers.</p>

        </div>
      </div>

    </div>
  </section><!-- End About Section -->
  <!-- ======= Counts Section ======= -->
  <section id="counts" class="counts section-bg">
    <div class="container">

      <div class="row counters">

        <div class="col-lg-3 col-6 text-center">
          <span data-purecounter-start="0" data-purecounter-end="1232" data-purecounter-duration="1" class="purecounter"></span>
          <p>Students</p>
        </div>

        <div class="col-lg-3 col-6 text-center">
          <span data-purecounter-start="0" data-purecounter-end="64" data-purecounter-duration="1" class="purecounter"></span>
          <p>Courses</p>
        </div>

        <div class="col-lg-3 col-6 text-center">
          <span data-purecounter-start="0" data-purecounter-end="42" data-purecounter-duration="1" class="purecounter"></span>
          <p>Events</p>
        </div>

        <div class="col-lg-3 col-6 text-center">
          <span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="1" class="purecounter"></span>
          <p>Trainers</p>
        </div>

      </div>

    </div>
  </section><!-- End Counts Section -->
  <section id="why-us" class="why-us">
    <div class="container" data-aos="fade-up">

      <div class="row">
        <div class="col-lg-4 d-flex align-items-stretch">
          <div class="content">
            <h3>Why Choose BetterLearn?</h3>
            <p>
            We’ve got the solution: world-class training and development programs developed by top universities and companies</p>
            <div class="text-center">
              <a href="about.html" class="more-btn">Learn More <i class="bx bx-chevron-right"></i></a>
            </div>
          </div>
        </div>
        <div class="col-lg-8 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
          <div class="icon-boxes d-flex flex-column justify-content-center">
            <div class="row">
              <div class="col-xl-4 d-flex align-items-stretch">
                <div class="icon-box mt-4 mt-xl-0">
                  <i class="bx bx-receipt"></i>
                  <h4>Start or advance your career</h4>
                  <p>Take the next step toward your personal and professional goals</p>
                </div>
              </div>
              <div class="col-xl-4 d-flex align-items-stretch">
                <div class="icon-box mt-4 mt-xl-0">
                  <i class="bx bx-cube-alt"></i>
                  <h4>Browse popular topics</h4>
                  <p>87% of people learning for professional development report career benefits like getting a promotion, a raise, or starting a new career</p>
                </div>
              </div>
              <div class="col-xl-4 d-flex align-items-stretch">
                <div class="icon-box mt-4 mt-xl-0">
                  <i class="bx bx-images"></i>
                  <h4>Popular courses and articles</h4>
                  <p>Break into a new field like information technology or data science. No prior experience necessary to get started.</p>
                </div>
              </div>
            </div>
          </div><!-- End .content-->
        </div>
      </div>

    </div>
  </section>
  <section id="popular-courses" class="courses">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Courses</h2>
        <p>Popular Courses</p>
      </div><div class="row" data-aos="zoom-in" data-aos-delay="100">
      @foreach ($items as $item)
      <?php
      $image = DB::table('courses')
      ->where('id' , $item->id)
      ->first();
      ?>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
          <div class="course-item">
            <img src="{{$image -> image}}" class="img-fluid" alt="...">
            <div class="course-content">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>{{$image -> cat}}</h4>
                <p class="price">${{$item -> price}}</p>
              </div>

              <h3><a href="{{route('details' , ['course_details' => $item -> id ])}}">{{$item -> name}}</a></h3>
              <p>{{$item -> Disc}}</p>
              <div class="trainer d-flex justify-content-between align-items-center">
                <div class="trainer-profile d-flex align-items-center">
                  <img src="{{$image -> actor_image}}" class="img-fluid" alt="">
                  <span>{{$item -> actor}}</span>
                </div>
                <div class="trainer-rank d-flex align-items-center">
                  <i class="bx bx-user"></i>&nbsp;50
                  &nbsp;&nbsp;
                  <i class="bx bx-heart"></i>&nbsp;65
                </div>
              </div>
            </div>
          </div>
        </div> <!-- End Course Item-->

      @endforeach


</main>
</section>
@endsection
