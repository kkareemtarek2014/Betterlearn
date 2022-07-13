<?php

namespace App\Http\Controllers;

use Cart;
use App\Models\course;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use App\Http\Requests\StorecourseRequest;
use App\Http\Requests\UpdatecourseRequest;

class CourseController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function databases()
    {
        $course = new course();
        $course -> name = "JavaScript";
        $course -> Disc = "The modern JavaScript course for everyone! Master JavaScript with projects, challenges and theory. Many courses in one! " ;
        $course -> actor = "kareem";
        $course -> featured = 1;
        $course -> cat = "website";
        $course -> price = 150;
        $course -> image = "assets\img\course5.jpg";
        $course -> actor_image = "assets\img\trainers\trainer-2.jpg";
        $course -> save();
    }
    public function index()
    {
        $items = DB::table('courses')
        ->get();
        //dd($items);
        return view('courses', ['items' => $items]);
    }
    public function marketing()
    {
        $items = DB::table('courses')
        ->where("cat","marketing")
        ->get();
        //dd($items);
        return view('courses', ['items' => $items]);
    }
    public function featured()
    {
        $items = DB::table('courses')
        ->where('featured' , 1)
        ->get();

        return view('home', ['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Pdelete($id)
    {
        $actor_image = course::find($id);
        $actor_old_image = $actor_image -> actor_image;

        if (file_exists($actor_old_image)) {unlink($actor_old_image);}

        $image = course::find($id);
        $old_image = $image -> image;
        if (file_exists($old_image)) {unlink($old_image);}

         course::find($id)->forceDelete();
        return Redirect()->back()->with('success','course PermanentlyDeleted Successfully');
    }

    public function AllBrand()
    {
        $courses = course::latest()->paginate(5);
        return view('admin.brand',compact('courses'));

    }
     /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorecourseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function AddNewCourse(Request $request)
    {
        $validatedData= $request -> validate([
            'name'=>'required|unique:courses|min:5',
            'Disc'=>'required|min:5',
            'cat'=>'required|min:3',
            'actor'=>'required|min:5',
            'price'=>'required',
            'featured'=>'required',

            'image'=>'required|mimes:jpg,jpeg,png,webp',
            'actor_image'=>'required|mimes:jpg,jpeg,png,webp',

        ],
        [
            'name.required'=> 'please Input Course name',
            'Disc.required'=> 'please Input Course Disc',
            'cat.required'=> 'please Input cat name',
            'actor.required'=> 'please Input actor name',
            'price.required'=> 'please Input price',

            'name.min'=> 'Course name more than 5 Chars',
            'Disc.min'=> 'Course Disc more than 5 Chars',
            'cat.min'=> 'Course cat more than 5 Chars',
            'actor.min'=> 'Course actor more than 5 Chars',
        ]);


        // $name_gen =hexdec(uniqid());
        // $img_ext= strtolower($image->getClientOriginalExtension());
        // $img_name=  $name_gen.'.'.$img_ext;
        // $up_location='assets/img/';
        // $image -> move($up_location,$img_name);

        $image =$request->file('image');

        $name_gen =hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(414,300)->save('assets/img/'.$name_gen);
        $last_img='assets/img/'. $name_gen ;


        $actor_image =$request->file('actor_image');

        $actor_gen =hexdec(uniqid()).'.'.$actor_image->getClientOriginalExtension();
        Image::make($actor_image)->resize(414,300)->save('assets/img/'.$actor_gen);
        $actor_last='assets/img/'. $actor_gen ;



        // $actor_gen =hexdec(uniqid());
        // $actor_img_ext= strtolower($actor_image->getClientOriginalExtension());
        // $actor_img_name=  $actor_gen.'.'.$actor_img_ext;
        // $actor_up_location= 'assets/img/';
        // $actor_last =$actor_up_location. $actor_img_name;
        // $actor_image -> move($actor_up_location,$actor_img_name);

        course::insert([
            'name' => $request->name,
            'Disc' => $request->Disc,

            'image' =>$last_img ,
            'actor' => $request->actor,
            'actor_image' => $actor_last,
            'featured' => $request->featured,
            'cat' => $request->cat,
            'price' => $request->price,
            'created_at' =>Carbon::now()
        ]);

        return Redirect()->back()->with('success'. 'Course Inserted Successfully');


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorecourseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $course = new Course();
        $course -> name = "Marketing";
        $course -> Disc = "ffewfwfeew";
        $course -> image = "assets/img/YBN-Cordae-pic.jpg";
        $course -> actor = "Kareem";
        $course -> actor_image = "assets/img/YBN-Cordae-pic.jpg";
        $course -> featured = 1;
        $course -> cat = "Website";
        $course -> price = 50;
        $course -> save();
    }
    public function getID($course_details)
    {
        $selected_course = DB::table('courses')
        ->where('id', $course_details)
        ->first();
        return view('details' ,['course' => $selected_course]);
    }
    public function addToCart($course_ID) {
        $selected_course = DB::table('courses')
        ->where('id', $course_ID)
        ->first();
        Cart::add($course_ID , $selected_course -> name , $selected_course ->price  , 1);
        return redirect()->route('cart');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatecourseRequest  $request
     * @param  \App\Models\course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatecourseRequest $request, course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(course $course)
    {
        //
    }
}
