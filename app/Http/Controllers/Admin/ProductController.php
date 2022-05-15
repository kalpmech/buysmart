<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['category','user'])->orderBy('id', 'DESC')->paginate(15);
        return View::make('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::Active()->get()->pluck('name','id');
        $users = User::Active()->get()->pluck('full_name','id');
        return View::make('admin.products.add-edit-product', compact('users','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|min:2|max:191|string|unique:products,name,NULL,id,deleted_at,NULL",
            "description" => "required|min:2|max:191",
            "tags" => "required|min:2|max:191",
            "features" => "required|min:2|max:191",
            "status" => "required|integer|in:0,1",
            "user_id" => "required|integer",
            "category_id" => "required|integer",
            "price" =>  "required|string",
            "brand" =>  "required|string",
            "rate_val" =>  "required|integer",
            // "image" => "nullable|image|mimes:jpeg,png,jpg|max:5120",
        ]);

        $product = new Product();

        if($request->hasFile('image')){
            $request->image->store('categories', 'public');
            $product->image = $request->image->hashName();
        }

        $product->name = $request->name;
        $product->description = $request->description;
        $product->tags = $request->tags;
        $product->features = $request->features;
        $product->user_id = $request->user_id;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->brand = $request->brand;
        $product->rate_val = $request->rate_val;
        $product->status = $request->status;
        $product->save();

        return redirect()->route('admin.products.index')->with('success','Product created successfully!');
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
        $product = Product::find(Crypt::decrypt($id));
        $categories = Category::Active()->get()->pluck('name','id');
        $users = User::Active()->get()->pluck('full_name','id');

        return View::make('admin.products.add-edit-product', compact('product','users','categories'));
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
        $product = Product::find(Crypt::decrypt($id));
        $productId = $product->id;

        $request->validate([
            "name" => "required|min:2|max:191|string|unique:products,name,NULL,id,deleted_at,NULL".$productId,
            "description" => "required|min:2|max:191",
            "tags" => "required|min:2|max:191",
            "features" => "required|min:2|max:191",
            "status" => "required|integer|in:0,1",
            "user_id" => "required|integer",
            "category_id" => "required|integer",
            "price" =>  "required|string",
            "brand" =>  "required|string",
            "rate_val" =>  "required|integer",
            // "image" => "nullable|image|mimes:jpeg,png,jpg|max:5120",
        ]);

        // $product = new Product();

        if($request->hasFile('image')){
            $request->image->store('categories', 'public');
            $product->image = $request->image->hashName();
        }

        $product->name = $request->name;
        $product->description = $request->description;
        $product->tags = $request->tags;
        $product->features = $request->features;
        $product->user_id = $request->user_id;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->brand = $request->brand;
        $product->rate_val = $request->rate_val;
        $product->status = $request->status;
        $product->save();

        return redirect()->route('admin.products.index')->with('success','Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find(Crypt::decrypt($id));
        // Storage::disk('public')->delete('products/'.$product->image);
        $product->delete();
        return redirect()->route('admin.products.index')->with('success','Product deleted successfully');
    }
}
