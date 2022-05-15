@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
   <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ isset($product) ? "Edit" : "Add"}} Product</h6>
        </div>
        @if (isset($product))
            <form method="POST" enctype="multipart/form-data" action="{{route('admin.products.update',Crypt::encrypt($product->id))}}">
            @method('PUT')
        @else
            <form method="POST" enctype="multipart/form-data" action="{{route('admin.products.store')}}">
        @endif
            @csrf
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="form-group">
                            <label for="name">Product Name</label>
                            @php
                            if(old('name'))
                                $name = old('name');
                            elseif(isset($product))
                                $name = isset($product->name) ? $product->name : '';
                            else
                                $name = "";
                            @endphp
                            <input type="text" class="form-control" name="name" id="name" required min="3" max="30" value="{{$name}}" placeholder="Enter name" />
                        </div>
                        <div class="form-group">
                            <label>User Name</label>
                            @php
                                if(old('user_id'))
                                    $user_id = old('user_id');
                                elseif(isset($product))
                                    $user_id = isset($product->user_id) ? $product->user_id : '';
                                else
                                    $user_id = "";
                            @endphp
                            <select class="custom-select" name="user_id" id="user_id" required>
                                @foreach ($users as $key => $value)
                                    <option value="{{$key}}" {{ isset($user_id) == $key ? 'selected' : ''}}>{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            @php
                                if(old('category'))
                                    $category_id = old('category_id');
                                elseif(isset($product))
                                    $category_id = isset($product->category_id) ? $product->category_id : '';
                                else
                                    $category_id = "";
                            @endphp
                            <select class="custom-select" name="category_id" id="category_id" required>
                                @foreach ($categories as $key => $value)
                                    <option value="{{$key}}" {{ isset($category_id) == $key ? 'selected' : ''}}>{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Price</label>
                            @php
                            if(old('price'))
                                $price = old('price');
                            elseif(isset($product))
                                $price = isset($product->price) ? $product->price : '';
                            else
                                $price = "";
                            @endphp
                            <input type="text" class="form-control" name="price" id="price" required min="3" max="30" value="{{$price}}" placeholder="Enter price" />
                        </div>
                        <div class="form-group">
                            <label for="name">Brand</label>
                            @php
                            if(old('brand'))
                                $brand = old('brand');
                            elseif(isset($product))
                                $brand = isset($product->brand) ? $product->brand : '';
                            else
                                $brand = "";
                            @endphp
                            <input type="text" class="form-control" name="brand" id="brand" required min="3" max="30" value="{{$brand}}" placeholder="Enter brand" />
                        </div>
                        <div class="form-group">
                            <label for="name">Rate Value</label>
                            @php
                            if(old('rate_val'))
                                $rate_val = old('rate_val');
                            elseif(isset($product))
                                $rate_val = isset($product->rate_val) ? $product->rate_val : '';
                            else
                                $rate_val = "";
                            @endphp
                            <input type="text" class="form-control" name="rate_val" id="rate_val" required value="{{$rate_val}}" placeholder="Enter rate value" />
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            @php
                            if(old('description'))
                                $description = old('description');
                            elseif(isset($product))
                                $description = isset($product->description) ? $product->description : '';
                            else
                                $description = "";
                            @endphp
                            <textarea name="description" class="form-control" id="description" placeholder="Enter description">{{$description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="tag">Tag</label>
                            @php
                            if(old('tags'))
                                $tags = old('tags');
                            elseif(isset($product))
                                $tags = isset($product->tags) ? $product->tags : '';
                            else
                                $tags = "";
                            @endphp
                            <textarea name="tags" class="form-control" id="tags" placeholder="Enter tags">{{$tags}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="features">Features</label>
                            @php
                            if(old('features'))
                                $features = old('features');
                            elseif(isset($product))
                                $features = isset($product->features) ? $product->features : '';
                            else
                                $features = "";
                            @endphp
                            <textarea name="features" class="form-control" id="features" placeholder="Enter features">{{$features}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            @php
                                if(old('status'))
                                    $status = old('status');
                                elseif(isset($product))
                                    $status = isset($product->status) ? $product->status : '';
                                else
                                    $status = "1";
                            @endphp
                            <select class="custom-select" name="status" id="status">
                                <option value="1" {{ isset($status) == 1 ? 'selected' : ''}}>Active</option>
                                <option value="0" {{ isset($status) == 0 ? 'selected' : ''}}>Deactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
   </div>
</div>
@endsection