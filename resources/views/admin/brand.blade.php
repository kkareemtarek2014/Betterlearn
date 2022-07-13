<x-app-layout>

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <img src="{{asset("assets\img\Untitled.png")}}" class="img-fluid" alt="...">
    </div>


    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="card-header center "> ADD Courses </div>


<table class="table table-striped table-hover overflow-auto" >
    <thead>
        <tr>

          <th scope="col">ADD Course Name</th>
          <th scope="col">ADD Course Iamge</th>
          <th scope="col">ADD Description</th>
          <th scope="col">ADD Category</th>

          <th scope="col">ADD actor</th>
          <th scope="col">ADD actor_image</th>
          <th scope="col">ADD featured</th>

          <th scope="col">ADD Price</th>



        </tr>
      </thead>
    <div class="form-group">
        <form  action="{{route('store.course')}}" method ="post"  enctype="multipart/form-data">
        <tr>
            <td >
              @csrf
                <input type='text' Style="width:100%" name="name" class="form_control" id="name" aria-describedby="name">
                @error('name')
                <span class="text-danger">{{$message}}</span>
                @enderror
                </td>
            <td>
<input type='file' name="image"Style="width:100px" class="form_control" id="image" aria-describedby="image">
@error('image')
<span class="text-danger">{{$message}}</span>
@enderror
</td>
<td>
    <input type='text' name="Disc"Style="width:150px" class="form_control" id="Disc" aria-describedby="Disc">
    @error('Disc')
    <span class="text-danger">{{$message}}</span>
    @enderror
    </td>
    <td>
        <input type='text' name="cat" Style="width:150px"class="form_control" id="cat" aria-describedby="cat">
        @error('cat')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </td>

<td>
    <input type='text' name="actor" Style="width:150px"class="form_control" id="actor" aria-describedby="actor">
    @error('actor')
    <span class="text-danger">{{$message}}</span>
    @enderror
    </td>
    <td>
        <input type='file'name="actor_image"Style="width:150px" class="form_control" id="actor_image" aria-describedby="ActorImage">
        @error('actor_image')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </td>
        <td>
            <input type='text'Style="width:150px" name="featured" class="form_control" id="featured" aria-describedby="featured">
            @error('featured')
            <span class="text-danger">{{$message}}</span>
            @enderror
            </td>
            <td>
                <input type='text'Style="width:150px" name="price" class="form_control" id="price" aria-describedby="price">
                @error('price')
                <span class="text-danger">{{$message}}</span>
                @enderror
                </td>
                <td>
                   <button type="submit" class="btn btn-primary"> Add Course</button>



                  </td></tr>
                </form>

  </table>
<div class="py-12">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">






                        <div class="card-header"> All Courses </div>
                <table class="table table-striped table-hover overflow-auto" >

                    @if(session('success'))

                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{session('success')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    @endif <thead>
                      <tr>

                        <th scope="col">Sl No</th>
                        <th scope="col">Course Name</th>
                        <th scope="col">Course Iamge</th>
                        <th scope="col">Description</th>
                        <th scope="col">Category</th>

                        <th scope="col">actor</th>
                        <th scope="col">actor_image</th>
                        <th scope="col">featured</th>

                        <th scope="col">Price</th>

                        <th scope="col">Created At</th>
                        <th scope="col">Action</th>

                      </tr>
                    </thead>
                    <tbody>

                        @foreach ($courses as $course)
                        <?php
                        $image = DB::table('courses')
                        ->where('id' , $course->id)
                        ->first();
                        ?>
                        <tr>
                          <th scope="row">{{$course -> id}}</th>
                          <td>{{$course -> name}}</td>

                          <td><img src="{{asset($image -> image)}}" class="img-fluid" alt="..."></td>
                          <td>{{$course -> Disc}}</td>
                          <td>{{$course -> cat}}</td>
                          <td>{{$course -> actor}}</td>

                          <td><img src="{{asset($image -> actor_image)}}" class="img-fluid" alt="..."></td>

                          <td>{{$course -> featured}}</td>
                          <td>{{$course -> price}}</td>
                          <td>{{Carbon\Carbon::parse($course -> created_at)->diffForHumans()}}</td>


                          <td>
                            <a href="{{ url('course/pdelete/'.$course->id)}}" onclick="return confirm('Are You sure to delete this course?')" class="btn btn-danger">P Delete</a>



                          </td>
                          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                        </tr>


                        @endforeach



                    </tbody>
                  </table>
                  {{ $courses->links()}}
                </div>

            </div>
        </div>
    </div>
</div>







</div>



</x-app-layout>
