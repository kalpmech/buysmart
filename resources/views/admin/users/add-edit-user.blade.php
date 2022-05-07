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
                            <label for="first_name">First Name</label>
                            @php
                            if(old('first_name'))
                                $first_name = old('first_name');
                            elseif(isset($user))
                                $first_name = isset($user->first_name) ? $user->first_name : '';
                            else
                                $first_name = "";
                            @endphp
                            <input type="text" class="form-control" name="first_name" id="first_name" required min="3" max="30" value="{{$first_name}}" placeholder="Enter first name" />
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            @php
                            if(old('last_name'))
                                $last_name = old('last_name');
                            elseif(isset($user))
                                $last_name = isset($user->last_name) ? $category->last_name : '';
                            else
                                $last_name = "";
                            @endphp
                            <input type="text" class="form-control" name="last_name" id="last_name" required min="3" max="30" value="{{$last_name}}" placeholder="Enter last name" />
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            @php
                            if(old('email'))
                                $email = old('email');
                            elseif(isset($user))
                                $email = isset($user->email) ? $user->email : '';
                            else
                                $email = "";
                            @endphp
                            <input type="text" class="form-control" name="first_name" id="first_name" required min="3" max="30" value="{{$email}}" placeholder="Enter email" />
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            @php
                            if(old('phone'))
                                $phone = old('phone');
                            elseif(isset($user))
                                $phone = isset($user->phone) ? $user->phone : '';
                            else
                                $phone = "";
                            @endphp
                            <input type="text" class="form-control" name="phone" id="phone" required min="3" max="30" value="{{$phone}}" placeholder="Enter phone" />
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            @php
                                if(old('status'))
                                    $status = old('status');
                                elseif(isset($user))
                                    $status = isset($user->status) ? $user->status : '';
                                else
                                    $status = "1";
                            @endphp
                            <select class="custom-select" name="status" id="status">
                                <option value="1" {{ isset($status) == 1 ? 'selected' : ''}}>Active</option>
                                <option value="0" {{ isset($status) == 0 ? 'selected' : ''}}>Deactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="date_of_birth">Date of Birth</label>
                            @php
                            if(old('date_of_birth'))
                                $date_of_birth = old('date_of_birth');
                            elseif(isset($user))
                                $date_of_birth = isset($user->date_of_birth) ? $user->date_of_birth : '';
                            else
                                $date_of_birth = "";
                            @endphp
                            <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" value="{{$date_of_birth}}"  />
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