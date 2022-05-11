@extends('admin.layouts.app')
@push('custom-css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endpush
@section('content')
<div class="container-fluid">
   <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ isset($user) ? "Edit" : "Add"}} User</h6>
        </div>
        @if (isset($user))
            <form method="POST" enctype="multipart/form-data" action="{{route('admin.users.update',Crypt::encrypt($user->id))}}">
            @method('PUT')
        @else
            <form method="POST" enctype="multipart/form-data" action="{{route('admin.users.store')}}">
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
                                $last_name = isset($user->last_name) ? $user->last_name : '';
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
                            <input type="email" class="form-control" name="email" id="email" required value="{{$email}}" placeholder="Enter email" />
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
                                $date_of_birth = date('m/d/Y',strtotime(old('date_of_birth')));
                            elseif(isset($user))
                                $date_of_birth = isset($user->date_of_birth) ? date('m/d/Y',strtotime($user->date_of_birth)) : null;
                            else
                                $date_of_birth = null;
                            @endphp
                            <input type="text" class="form-control" name="date_of_birth" id="date_of_birth" value="{{ $date_of_birth }}"  />
                        </div>
                        <div class="form-group">
                            <label for="address">address</label>
                            @php
                            if(old('address'))
                                $address = old('address');
                            elseif(isset($user))
                                $address = isset($user->address) ? $user->address : '';
                            else
                                $address = "";
                            @endphp
                            <textarea name="address" class="form-control" id="address" placeholder="Enter address">{{$address}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="zip_code">Zip Code</label>
                            @php
                            if(old('zip_code'))
                                $zip_code = old('zip_code');
                            elseif(isset($user))
                                $zip_code = isset($user->zip_code) ? $user->zip_code : '';
                            else
                                $zip_code = "";
                            @endphp
                            <input type="text" class="form-control" name="zip_code" id="zip_code" value="{{$zip_code}}" placeholder="Zip code" minlength="5" maxlength="9"/>
                        </div>
                        <div class="form-group">
                            <label>User Type</label>
                            @php
                                if(old('user_type')){
                                    $user_type = old('user_type');
                                }elseif(isset($user)){
                                    $user_type = isset($user->user_type) ? $user->user_type : '';
                                }else{
                                    $user_type = "customer";
                                }
                            @endphp
                            <select class="custom-select" name="user_type" id="user_type">
                                <option value="admin" {{ isset($user_type) && $user_type == 'admin' ? 'selected' : ''}}>Admin</option>
                                <option value="customer" {{ isset($user_type) && $user_type == 'customer' ? 'selected' : ''}}>Customer</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="avatar">Avatar</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="avatar" name="avatar" />
                                            <label class="custom-file-label" for="avatar">Choose file</label>
                                        </div>
                                    </div>
                                </div>  
                            </div>  
                            <div class="col-md-6">
                                @php 
                                    if(isset($user->avatar)){
                                        $avatar = $user->avatar;
                                    }else{
                                        $avatar = "";
                                    }
                                @endphp
                                    
                                @if(isset($user) && $user->avatar != null )
                                    <img src="{{url('storage/users/',$avatar)}}" alt="{{$avatar}}" width="100" height="100" iclass="img-thumbnail"/>
                                @endisset
                            </div>
                        </div>
                        <div class="form-group pl-4">
                            @php
                            if(old('is_terms_accepted'))
                                $is_terms_accepted = old('is_terms_accepted');
                            elseif(isset($user))
                                $is_terms_accepted = isset($user->is_terms_accepted) ? $user->is_terms_accepted : '';
                            else
                                $is_terms_accepted = "";
                            @endphp
                            <input type="checkbox" class="form-check-input" id="is_terms_accepted" value="1" disabled checked ame="is_terms_accepted" id="is_terms_accepted" value="{{$is_terms_accepted}}">
                            <label class="form-check-label" for="is_terms_accepted">I Agree Terms & Coditions</label>
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
@push('custom-scripts')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
    $('#date_of_birth').datepicker({  
       format: 'mm/dd/yyyy'
     });  
</script>
@endpush