@extends('layout')
@section('content')

@if (Cart::getContent()->count()==0)
<h1> Return to Courses</h1>
@else
<!--Main layout-->
<main class="mt-5 pt-4" >
    <div class="breadcrumbs" >
        <div class="container">
      <h2 >Checkout form</h2>
      </div></div>
    <div class="container wow fadeIn" >

      <!-- Heading -->
      <div class="row">
        <div class="col-md-8 mb-4">

          <div class="card">

            <!--Card content-->
            <!---------------form--------------->
            <form class="card-body" action="{{route('store')}}" method="get">
             @csrf

              <div class="row">
                <div class="col-md-6 mb-2">

                  <!--firstName-->
                  <div class="md-form ">
                    <input type="text" name="firstName"  class="form-control">
                    <label for="firstName" >First name</label>
                  </div>

                </div>

                <div class="col-md-6 mb-2">
                  <!--lastName-->
                  <div class="md-form">
                    <input type="text" name="lastName" class="form-control">
                    <label for="lastName" class="">Last name</label>
                  </div>

                </div>
              </div>

              <!--email-->
              <div class="md-form mb-5">
                <input type="text" name="email" class="form-control" placeholder="youremail@example.com">
                <label for="email" class="">Email (optional)</label>
              </div>

              <!--address-->
              <div class="md-form mb-5">
                <input type="text" name="address" class="form-control" placeholder="1234 Main St">
                <label for="address" class="">Address</label>
              </div>

              <!--Zip-->
              <div class="row">

                <div class="col-lg-4 col-md-6 mb-4">

                  <label for="zip">Zip</label>
                  <input type="text" class="form-control" name="zip" placeholder="" required>
                  <div class="invalid-feedback">
                    Zip code required.
                  </div>

                </div>
              </div>

              <!--Payment-->

              <div class="d-block my-3">
                <div class="custom-control custom-radio">
                  <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                  <label class="custom-control-label" for="credit">Credit card</label>
                </div>

                <div class="custom-control custom-radio">
                  <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
                  <label class="custom-control-label" for="paypal">Paypal</label>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="cc-name">Name on card</label>
                  <input type="text" class="form-control" name="ccname" placeholder="" required>
                  <small class="text-muted">Full name as displayed on card</small>
                  <div class="invalid-feedback">
                    Name on card is required
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="cc-number">Credit card number</label>
                  <input type="text" class="form-control" name="ccnumber" placeholder="" required>
                  <div class="invalid-feedback">
                    Credit card number is required
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3 mb-3">
                  <label for="cc-expiration">Expiration</label>
                  <input type="text" class="form-control" name="ccexpiration" placeholder="" required>
                  <div class="invalid-feedback">
                    Expiration date required
                  </div>
                </div>
                <div class="col-md-3 mb-3">
                  <label for="cc-expiration">CVV</label>
                  <input type="text" class="form-control" name="cccvv" placeholder="" required>
                  <div class="invalid-feedback">
                    Security code required
                  </div>
                </div>
              </div>
              <hr class="mb-4">
              <button type="submit" type="button" href = "{{route('store')}}" class="btn btn-primary btn-lg btn-block" >Continue to checkout</button>

            </form>
            <!---end form---->
          </div>
        </div>

        <div class="col-md-4 mb-4">
            @foreach ( Cart::getContent() as $item)
            <?php
            $image = DB::table('courses')
            ->where('id' , $item->id)
            ->first();
            ?>
          <!-- Heading -->
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Your cart</span>
            <span class="badge badge-secondary badge-pill">3</span>
          </h4>

          <!-- Cart -->
          <ul class="list-group mb-3 z-depth-1">
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Product name</h6>
                <small class="text-muted">Description</small>
              </div>


            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">{{$item -> name}}</h6>
                <small>{{$image -> cat}}</small>

              </div>
              <span class="text-muted"> ${{$item -> quantity * $item -> price}}</span>
            </li>

            <li class="list-group-item d-flex justify-content-between">
              <span>Total (USD)</span>
              <strong>{{Cart::getTotal()}}</strong>
            </li>
          </ul>
          <!-- Cart -->
@endforeach

        </div>
    </div>
    </div>
  </main>
  <!--Main layout-->

@endif
@endsection
