<?php

namespace App\Http\Controllers;
use Cart;
use Illuminate\Http\Request;

class cartcontoller extends Controller
{
    public function delete()
    {
        Cart::clear();
        return redirect()->route('courses');
    }
    public function destroy($itemid)
    {
        Cart::remove($itemid);
        return back();
    }
}
