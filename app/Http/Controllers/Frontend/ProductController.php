<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function homePage()
    {
        return view('welcome');
    }
    
    public function contactus()
    {
        return view('frontend.contactus');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function womenPage(Request $request)
    {
        $products = Product::query();
        $categories = Category::where('gender',2)->Active()->pluck('name','id');
        if(!empty($request->all())){ 
            if (isset($request->category_id) && !empty($request->category_id)) {
                $products->whereIn('category_id', $request->category_id);
            }else{
                $products->whereIn('category_id',array_keys($categories->toArray()));
            }
            $products->Filter($request->all());    
        }else{
            $products->whereIn('category_id',array_keys($categories->toArray()));
        }
        $products = $products->orderBy('id','desc')->Active()->with('images')->get();
        return view('frontend.women', compact('categories','products'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manPage(Request $request)
    {
        $products = Product::query();
        $categories = Category::where('gender',1)->Active()->pluck('name','id');
        if(!empty($request->all())){ 
            if (isset($request->category_id) && !empty($request->category_id)) {
                $products->whereIn('category_id', $request->category_id);
            }else{
                $products->whereIn('category_id',array_keys($categories->toArray()));
            }
            $products->Filter($request->all());    
        }else{
            $products->whereIn('category_id',array_keys($categories->toArray()));
        }
        $products = $products->orderBy('id','desc')->Active()->get();
        
        return view('frontend.men', compact('categories','products'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function kidsPage(Request $request)
    {  
        $products = Product::query();
        $categories = Category::where('gender',3)->Active()->pluck('name','id');
        if(!empty($request->all())){ 
            if (isset($request->category_id) && !empty($request->category_id)) {
                $products->whereIn('category_id', $request->category_id);
            }else{
                $products->whereIn('category_id',array_keys($categories->toArray()));
            }
            $products->Filter($request->all());    
        }else{
            $products->whereIn('category_id',array_keys($categories->toArray()));
        }
        $products = $products->orderBy('id','desc')->Active()->get();
        return view('frontend.kids', compact('categories','products'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($type,$id)
    {
        $product = Product::find(Crypt::decrypt($id));
        return View::make('frontend.product-details',compact('product'));
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
