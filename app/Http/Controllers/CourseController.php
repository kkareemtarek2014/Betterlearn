<?php

namespace App\Http\Controllers;

use App\Models\course;
use Illuminate\Support\Facades\DB;
use Cart;
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


    public function create()
    {
//
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
