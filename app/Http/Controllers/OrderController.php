<?php

namespace App\Http\Controllers;

use Cart ;
use App\Models\order;
use App\Models\report;
use App\Http\Requests\StoreorderRequest;
use App\Http\Requests\UpdateorderRequest;
use App\Http\controllers\encrypt;
use Illuminate\Http\Request;
use App\Http\controllers\tripleDes;
use App\Http\controllers\RC4;
use App\Http\controllers\Blowfish;
use Illuminate\Support\Facades\Session;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
     * @param  \App\Http\Requests\StoreorderRequest  $request
     * @return \Illuminate\Http\Response
     */


    function addData(Request $req)
    {

        $report = new report();
        $order = new order();
        $order-> fnam = $req->input('firstName');
        $report-> fnam = $req->input('firstName');
        $order-> lnam = $req->input('lastName');
        $report-> lnam = $req->input('lastName');
        $order-> email = $req->input('email');
        $report-> email = $req->input('email');
        $order-> address = $req->input('address');
        $order-> zip = $req->input('zip');
        $order-> nameoncard = $req->input('ccname');
        $report-> nameoncard = $req->input('ccname');

        $randomNumber = rand(1,2);
        $order -> random = $randomNumber;
        $report -> random = $randomNumber;
        $secret_key = '23187SJAE382EJQW!2DSA';
        $iv = '23187SJAE382EJQW!2DSA';

        if($randomNumber == 1)
        {
            $report -> typencrypt = "AES";
            $temp = app('App\Http\Controllers\encrypt')->encrypt_decrypt('encrypt' , $req->input('ccnumber'));
            $order-> cardnumber = $temp;
            $report -> encrypt = $temp;
            $report -> crypt = app('App\Http\Controllers\encrypt')->encrypt_decrypt('decrypt' , $temp);
        }
        else if($randomNumber == 2)
        {
            $report -> typencrypt = "RC4";

           $enc = base64_encode(app('App\Http\Controllers\RC4')->encrypt('secret_key' , $req->input('ccnumber')));
            $order-> cardnumber = $enc ;
            $report -> encrypt = $order-> cardnumber;
            $dec =  base64_decode($enc);
            $report -> crypt = app('App\Http\Controllers\RC4')->decrypt('secret_key' , $dec);
        }


        $report-> exp = $req->input('ccexpiration');
        $report-> cvv = $req->input('cccvv');
        $order-> exp = $req->input('ccexpiration');
        $order-> cvv = $req->input('cccvv');
        Cart::clear();
        $order->save();
        Session::put('secretkey',encrypt_decrypt('encrypt',$secret_key));

        return redirect()->route('Thankyou');

    }


}
