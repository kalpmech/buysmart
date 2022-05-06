<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(15);
        return View::make('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('admin.categories.add-edit-category');
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
            "name" => "required|min:2|max:191|string|unique:categories,name,NULL,id,deleted_at,NULL",
            "description" => "required|min:2|max:191",
            "status" => "required|integer|in:0,1",
            "image" => "nullable|image|mimes:jpeg,png,jpg|max:5120",
        ]);

        if($request->hasFile('image')){
            $request->image->store('categories', 'public');
        }

        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->status = $request->status;
        $category->image = $request->image->hashName();
        $category->save();

        return redirect()->route('admin.categories.index')->with('success','Category created successfully!');
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
        $category = Category::find(Crypt::decrypt($id));
        return View::make('admin.categories.add-edit-category',compact('category'));
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
        $category = Category::find(Crypt::decrypt($id));
        $categoryId = $category->id;

        $request->validate([
            "name" => "required|min:2|max:191|string|unique:categories,name,NULL,id,deleted_at,NULL".$categoryId,
            "description" => "required|min:2|max:191",
            "status" => "required|integer|in:0,1",
            "image" => "nullable|image|mimes:jpeg,png,jpg|max:5120",
        ]);
        if($request->hasFile('image')){
            $request->image->store('categories', 'public');
        }
        $category->name = $request->name;
        $category->description = $request->description;
        $category->status = $request->status;
        $category->image = $request->image->hashName();
        $category->save();
        
        return redirect()->route('admin.categories.index')->with('success','Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {    
        $category = Category::find(Crypt::decrypt($id));
        Storage::disk('public')->delete('categories/'.$category->image);
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success','Category deleted successfully');
    }
}
