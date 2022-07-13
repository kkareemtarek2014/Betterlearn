<?php

namespace App\Http\Controllers;

use Auth;
use Cart ;
use App\Models\User;
use App\Models\order;
use App\Models\report;
use Illuminate\Http\Request;
use App\Http\controllers\RC4;
use App\Http\controllers\encrypt;
use App\Http\controllers\Blowfish;
use Illuminate\Support\Facades\DB;
use App\Http\controllers\tripleDes;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StoreorderRequest;
use App\Http\Requests\UpdateorderRequest;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Edit($id)
    {
        $orders = order::find($id);
        return view ('admin.edit',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allorder()
    {
        // $orders =DB::table('orders')
        // ->join('users','orders.user_id','user_id')
        // ->select('orders.*','users.name')
        // ->latest()->paginate(5);
        $orders = order::latest()->paginate(5);

        return view("admin.Allorders",compact('orders'));
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
        $order->user_id= Auth::user()->id;

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

        $randomNumber = rand(1,3);
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

            $ccexpiration = base64_encode(app('App\Http\Controllers\encrypt')->encrypt_decrypt('encrypt' ,$req->input('ccexpiration')));
            $order-> exp = $ccexpiration;
            $report -> exp =  $order-> exp;

            $cvv = base64_encode(app('App\Http\Controllers\encrypt')->encrypt_decrypt('encrypt' ,$req->input('cccvv')));
            $order-> cvv = $cvv ;
            $report -> cvv= $order-> cvv;
        }
        else if($randomNumber == 2)
        {
            $report -> typencrypt = "RC4";

           $enc = base64_encode(app('App\Http\Controllers\RC4')->encrypt('secret_key' , $req->input('ccnumber')));
             $order-> cardnumber = $enc;
            $report -> encrypt = $order-> cardnumber;
            $dec =  base64_decode($enc);
            $report -> crypt = app('App\Http\Controllers\RC4')->decrypt('secret_key' , $dec);
            $ccexpiration = base64_encode(app('App\Http\Controllers\RC4')->encrypt('secret_key' ,$req->input('ccexpiration')));
            $order-> exp = $ccexpiration;
            $report -> exp =  $order-> exp;

            $cvv = base64_encode(app('App\Http\Controllers\RC4')->encrypt('secret_key' ,$req->input('cccvv')));
            $order-> cvv = $cvv ;
            $report -> cvv= $order-> cvv;

        }
        else if($randomNumber == 3)
        {
            $report -> typencrypt = "TripleDes";

           $enc = base64_encode(app('App\Http\Controllers\RC4')->encrypt('secret_key' , $req->input('ccnumber')));
            $ciphertext1 = openssl_encrypt($req->input('ccnumber'), 'DES-EDE3', 'secret_key', OPENSSL_RAW_DATA);
            $enc = base64_encode($ciphertext1);
            $order-> cardnumber = $enc ;
            $report -> encrypt = $order-> cardnumber;
            $dec =  base64_decode($enc);
            $report -> crypt = openssl_decrypt( $dec, 'DES-EDE3', 'secret_key', OPENSSL_RAW_DATA);

            $ciphertext2 = openssl_encrypt($req->input('cccvv'), 'DES-EDE3', 'secret_key', OPENSSL_RAW_DATA);
            $cvv = base64_encode($ciphertext2);
            $report-> cvv = $cvv;

            $ciphertext3 = openssl_encrypt($req->input('ccexpiration'), 'DES-EDE3', 'secret_key', OPENSSL_RAW_DATA);
            $ccexpiration = base64_encode($ciphertext3);
            $report-> cvv = $cvv;
            $report-> exp = $ccexpiration;
            $order-> exp = $ccexpiration;
            $order-> cvv = $cvv;
        }


        Cart::clear();
        $order->save();
        $report -> save();

        return redirect()->route('Thankyou');

    }


}
