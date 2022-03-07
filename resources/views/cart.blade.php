@extends('layout')
@section('content')

<section class='white'>







</section>
@if (Cart::getContent()->count() == 0)
<div class="container">
    <h1> Return Back To Courses</h1>
</div>

    @else
    <section id="cart" class="py-3">
        <div class="container-fluid w-75">
            <h5 class="font-baloo font-size-20">Shopping Cart</h5>

            <!--  shopping cart items   -->
                <class="row">
                    <class="col-sm-9">
                        @foreach ( Cart::getContent() as $item)
                            <!-- cart item -->
                            <?php
                            $image = DB::table('courses')
                            ->where('id' , $item->id)
                            ->first();
                            ?>

                            <div class="row border-top py-3 mt-3">
                                <div class="col-sm-2">
                                    <img src="{{asset($image -> image)}}" style="height: 120px;" alt="cart1" class="img-fluid">
                                </div>
                                <div class="col-sm-8">
                                    <h5 class="font-baloo font-size-20">{{$item -> name}}</h5>
                                    <small>{{$image -> cat}}</small>



                                    <!-- product qty -->
                                        <div class="qty d-flex pt-2">
                                            <a href="{{route('cart.destroy',$item-> id)}}" class="btn font-baloo text-danger px-3 border-right">Delete</a>
                                        </div>
                                    <!-- !product qty -->

                                </div>

                                <div class="col-sm-2 text-right">
                                    <div class="font-size-20 text-danger font-baloo">
                                        <span class="product_price"> ${{$item -> quantity * $item -> price}}</span>
                                    </div>
                                </div>
                            </div>
                        <!-- !cart item -->
                        @endforeach

                        <!-- cart item -->

                                <!-- !product qty -->


                                <!-- product qty -->

        </div>


                <!-- !cart item -->
                </div>
                <!-- subtotal section-->
                <div class="flex1">
                    <div class="sub-total border text-center mt-2">
                        <h6 class="font-size-12 font-rale text-success py-3"><i class="fas fa-check"></i> Buy By Mastercard or Visa </h6>
                        <div class="border-top py-4">
                            <h5 class="font-baloo font-size-20">Subtotal :&nbsp; <span class="text-danger">$<span class="text-danger" id="deal-price">{{Cart::getTotal()}}</span> </span> </h5>
                            <a href = "{{route('checkout')}}" class="btn btn-warning mt-3">Proceed to Buy</a>

                            <a  href = "{{route('cart.delete')}}" class="btn btn-danger mt-3">Delete</a>

                        </div>
                    </div>
                </div>
                <!-- !subtotal section-->
            </div>
        <!--  !shopping cart items   -->
        </div></section>
        </section>



            <!-- ======= Counts Section ======= -->
            <section id="counts" class="counts section-bg padding="45"">
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



            </main>



        @endsection

@endif
