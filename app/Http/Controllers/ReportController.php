<?php

namespace App\Http\Controllers;

use App\Models\report;
use App\Http\Requests\StorereportRequest;
use App\Http\Requests\UpdatereportRequest;
use Illuminate\Http\Request;
use App\Http\controllers\OrderController;
class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StorereportRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorereportRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatereportRequest  $request
     * @param  \App\Models\report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatereportRequest $request, report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(report $report)
    {
        //
    }
    function addData(Request $req)
    {


        $report = new report();
        $report-> fnam = $req->input('firstName');
        $report-> lnam = $req->input('lastName');
        $report-> email = $req->input('email');
        $report-> nameoncard = $req->input('ccname');
        $report-> encrypt = $req->input('encrypt');


        $randomNumber = rand(1,2);
        $report -> random = $randomNumber;
        if($randomNumber == 1)
        {
            $temp = app('App\Http\Controllers\encrypt')->encrypt_decrypt('encrypt' , $req->input('ccnumber'));
            $report-> cardnumber = $temp;
        }
        else
        {
            $temp = app('App\Http\Controllers\RC4')->encrypt('crypt_key' , $req->input('ccnumber'));
            $report-> cardnumber = $temp;
        }

        $report-> exp = $req->input('ccexpiration');
        $report-> cvv = $req->input('cccvv');
        $report->save();


    }
}
