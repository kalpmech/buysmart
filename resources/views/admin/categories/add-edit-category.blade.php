@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
   <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ isset($category) ? "Edit" : "Add"}} Category</h6>
        </div>
        @if (isset($category))
            <form method="POST" enctype="multipart/form-data" action="{{route('admin.categories.update',Crypt::encrypt($category->id))}}">
            @method('PUT')
        @else
            <form method="POST" enctype="multipart/form-data" action="{{route('admin.categories.store')}}">
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
                            <label for="name">Name</label>
                            @php
                            if(old('name'))
                                $name = old('name');
                            elseif(isset($category))
                                $name = isset($category->name) ? $category->name : '';
                            else
                                $name = "";
                            @endphp
                            <input type="text" class="form-control" name="name" id="name" required min="3" max="30" value="{{$name}}" placeholder="Enter name" />
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            @php
                            if(old('description'))
                                $description = old('description');
                            elseif(isset($category))
                                $description = isset($category->description) ? $category->description : '';
                            else
                                $description = "";
                            @endphp
                            <textarea name="description" class="form-control" id="description" placeholder="Enter description">{{$description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            @php
                                if(old('status'))
                                    $status = old('status');
                                elseif(isset($category))
                                    $status = isset($category->status) ? $category->status : '';
                                else
                                    $status = "1";
                            @endphp
                            <select class="custom-select" name="status" id="status">
                                <option value="1" {{ isset($status) == 1 ? 'selected' : ''}}>Active</option>
                                <option value="0" {{ isset($status) == 0 ? 'selected' : ''}}>Deactive</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="image" name="image" />
                                            <label class="custom-file-label" for="image">Choose file</label>
                                        </div>
                                    </div>
                                </div>  
                            </div>  
                            <div class="col-md-6">
                                @php 
                                    if(isset($category->image)){
                                        $image = $category->image;
                                    }else{
                                        $image = "";
                                    }
                                @endphp
                                    
                                @if(isset($category) && $category->image != null )
                                    <img src="{{url('storage/categories/',$image)}}" alt="{{$image}}" width="100" height="100" iclass="img-thumbnail"/>
                                @endisset
                            </div>
                        </div>
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