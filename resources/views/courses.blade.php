@extends('layout')
@section('content')
<h1>Hello </h1>

<div class="breadcrumbs">
    <div class="container">
      <h2>Courses</h2>
      <p>Learners around the world are launching new careers, advancing in their fields, and enriching their lives. </p>
    </div>
</div>
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
  <!-- ======= Courses Section ======= -->
<section id="courses" class="courses"style="width:100%">
    <div class="course-warp">
      <ul class="course-filter controls">
        <li class="control active" data-filter="all">All</li>
        <li class="control" data-filter=".finance">Finance</li>
        <li class="control" data-filter=".design">Design</li>
        <li class="control" data-filter=".web">Web Development</li>
        <li class="control" data-filter=".photo">Photography</li>
      </ul>
    <div class="container" data-aos="fade-up">

      <div class="row" data-aos="zoom-in" data-aos-delay="100">



        @foreach ($items as $item )
        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
            <div class="course-item">
            <img src=" {{asset($item -> image)}}" class="img-fluid" alt="...">
              <div class="course-content">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <h4>{{$item -> cat}}</h4>
                  <p class="price">${{ $item -> price}}</p>
                </div>

                <h3><a href="{{route('details' , ['course_details' => $item -> id ])}}">{{$item -> name}}</a></h3>
                <p>{{$item -> Disc}}</p>
                <div class="trainer d-flex justify-content-between align-items-center">
                  <div class="trainer-profile d-flex align-items-center">
                    <img src="{{asset($item -> actor_image)}}" class="img-fluid" alt="">
                    <span>{{$item -> actor}}</span>
                  </div>
                  <div class="trainer-rank d-flex align-items-center">
                    <i class="bx bx-user"></i>&nbsp;35
                    &nbsp;&nbsp;
                    <i class="bx bx-heart"></i>&nbsp;42
                  </div>
                </div>
              </div>
            </div>
          </div> <!-- End Course Item-->
        @endforeach




    </div></div>
  </section><!-- End Courses Section -->

</main>

@endsection
