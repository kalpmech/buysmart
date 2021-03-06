<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartItems = Cart::where('user_id',Auth::id())->get();
        return view('frontend.shop-cart',compact('cartItems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $cart = new Cart();
        $cart->user_id = Auth::id();
        $cart->product_id = $request->id;
        $cart->name = $request->name;
        $cart->price = $request->price;
        $cart->quantity = $request->quantity;
        $cart->total =  $request->price * $request->total;
        $cart->save();
        return Redirect::back()->with(['status'=>'Item added in cart!']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateCart(Request $request)
    {
        $cart = Cart::find($request->id);
        $total = ($cart->price * $request->quantity);
        $cart->quantity = $request->quantity;
        $cart->total = $total;
        $cart->save();
        return Redirect::back()->with(['status'=>'Cart updated successfully !!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function removeCart($id)
    {
        $cart = Cart::find(Crypt::decrypt($id));
        $cart->delete();
        return Redirect::back()->with(['status'=>'Item removed from cart!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function clearAllCart($id)
    {
        //
    }
}
