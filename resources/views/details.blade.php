<title> Details </title>
@extends('layout')
@section('content')

<!-- ======= Breadcrumbs ======= -->
<div class="breadcrumbs" data-aos="fade-in">
    <div class="container">
      <h2>Course Details</h2>
      <p>{{$course -> Disc}} </p>
    </div>
  </div><!-- End Breadcrumbs -->

  <!-- ======= Course Details Section ======= -->
<section id="course-details" class="course-details">
    <div class="container" data-aos="fade-up">

      <div class="row">
        <div class="col-lg-8">
          <img src="{{asset($course -> image)}}" class="img-fluid" alt="">
          <h3>{{$course -> name}}</h3>
          <p>{{$course -> Disc}}</p>
        </div>
        <div class="col-lg-4">

          <div class="course-info d-flex justify-content-between align-items-center">
            <h5>Trainer</h5>
            <p><a href="#">{{$course -> actor}}</a></p>
          </div>

          <div class="course-info d-flex justify-content-between align-items-center">
            <h5>Course Fee</h5>
            <p>{{$course -> price}}</p>
          </div>

          <div class="course-info d-flex justify-content-between align-items-center">
            <h5>Available Seats</h5>
            <p>30</p>
          </div>

          <div class="course-info d-flex justify-content-between align-items-center">
            <h5>Schedule</h5>
            <p>5.00 pm - 7.00 pm</p>
          </div>
          <div class="course-info d-flex justify-content-between align-items-center center-align">
            <button type="submit" class="btn btn-danger form-control color-white">Buy Now</button>
          </div>
          <div class="course-info d-flex justify-content-between align-items-center center-align">
            <a href = "{{route('cart.add' , ['course_ID' => $course -> id])}}" class="btn btn-warning form-control color-white">Add to Cart</a>
          </div>
        </div>
      </div>

    </div>
  </section><!-- End Course Details Section -->

@endsection
