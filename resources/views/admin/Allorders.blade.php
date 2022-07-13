<x-app-layout>

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <img src="{{asset("assets\img\Orders.jpg")}}" class="img-fluid" alt="...">
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">

                        @if(session('success'))

                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{session('success')}}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>
                            @endif




                        </div>

                        <div class="card-header"> All Order </div>
                <table class="table table-striped table-hover">
                    <thead>
                      <tr>

                        <th scope="col">Sl No</th>
                        <th scope="col">User</th>
                        <th scope="col">firstName</th>
                        <th scope="col">lastName</th>
                        <th scope="col">email</th>

                        <th scope="col">address</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Action</th>

                      </tr>
                    </thead>
                    <tbody>

                        @foreach ($orders as $order)

                        <tr>
                          <th scope="row">{{$order -> id}}</th>
                          <td>{{$order -> user->name}}</td>
                          <td>{{$order -> fnam}}</td>
                          <td>{{$order -> lnam}}</td>
                          <td>{{$order -> email}}</td>
                          <td>{{$order -> address}}</td>
                          <td>{{Carbon\Carbon::parse($order -> created_at)->diffForHumans()}}</td>


                          <td>
                              <a href="{{ url('softdelete/order/'.$order->id)}}" class="btn btn-danger">Delete</a>



                          </td>

                        </tr>


                        @endforeach



                    </tbody>
                  </table>
                  {{ $orders->links()}}

            </div>
        </div>
    </div>
</div>


































<!-- Trash Part  -->

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="container">
                <div class="row">

<div class="card-header">Trash List</div>
            <table class="table table-striped table-hover">
                <thead>
                  <tr>

                    <th scope="col">Sl No</th>
                    <th scope="col">User</th>
                    <th scope="col">firstName</th>
                    <th scope="col">lastName</th>
                    <th scope="col">email</th>

                    <th scope="col">address</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Action</th>

                  </tr>
                </thead>
                <tbody>

                    @foreach ($orders as $order)

                    <tr>
                      <th scope="row">{{$order -> id}}</th>
                      <td>{{$order -> user->name}}</td>
                      <td>{{$order -> fnam}}</td>
                      <td>{{$order -> lnam}}</td>
                      <td>{{$order -> email}}</td>
                      <td>{{$order -> address}}</td>
                      <td>{{Carbon\Carbon::parse($order -> created_at)->diffForHumans()}}</td>


                      <td>
                          <a href="{{ url('Order/restore/'.$order->id)}}" class="btn btn-secondary">Restore</a>
                          <a href="{{ url('Order/pdelete/'.$order->id)}}" class="btn btn-danger">P Delete</a>



                      </td>

                    </tr>


                    @endforeach



                </tbody>
              </table>
              {{ $orders->links()}}

        </div>
    </div>
</div>   </div>
 <!-- End Trash -->
</div>





</x-app-layout>
