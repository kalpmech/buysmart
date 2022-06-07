<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function placeOrder()
    {   
        $userCart = Cart::where('user_id',Auth::id())->get();

        $order = new Order();
        $order->user_id = Auth::id();
        $total = [];
        $cartProducts = [];
        foreach($userCart as $val){
            $cartProduct['product_id'] = $val->product_id;
            $cartProduct['name'] = $val->name;
            $cartProduct['price'] = $val->price;
            $cartProduct['quantity'] = $val->quantity;
            $cartProducts[] = $cartProduct;
            $total[] = $val->price;
        }

        $order->product_details = json_encode($cartProducts);
        $order->order_total = array_sum($total);
        $order->pay_type = 'creditcard';
        $order->status = 'confirmed';
        $order->save();

        Cart::where('user_id',Auth::id())->delete();
        return redirect()->route('cart')->with('status','order place successfully!');
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
