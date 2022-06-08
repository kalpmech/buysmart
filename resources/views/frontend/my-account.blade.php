@extends('frontend.partials.app')
@section('content')
        <!-- Contact Section Begin -->
        <section class="contact spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="contact__content">
                            <div class="contact__form">
                                <h5>My Account Info</h5>
                                <form action="{{route('admin.users.update',Crypt::encrypt($user->id))}}" method="POST" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf

                                    @php
                                        if(old('first_name'))
                                            $first_name = old('first_name');
                                        elseif(isset($user))
                                            $first_name = isset($user->first_name) ? $user->first_name : '';
                                        else
                                            $first_name = "";
                                    @endphp
                                        <input type="text" name="first_name" placeholder="Fitst Name" value="{{$first_name}}" required>
                                    @php
                                        if(old('last_name'))
                                            $last_name = old('last_name');
                                        elseif(isset($user))
                                            $last_name = isset($user->last_name) ? $user->last_name : '';
                                        else
                                            $last_name = "";
                                    @endphp
                                        <input type="text" name="last_name" placeholder="Last Name" value="{{$last_name}}" required>
                                    @php
                                        if(old('email'))
                                            $email = old('email');
                                        elseif(isset($user))
                                            $email = isset($user->email) ? $user->email : '';
                                        else
                                            $email = "";
                                    @endphp
                                        <input type="email" name="email" placeholder="Email" required value="{{$email}}" required> 
                                    @php
                                        if(old('phone'))
                                            $phone = old('phone');
                                        elseif(isset($user))
                                            $phone = isset($user->phone) ? $user->phone : '';
                                        else
                                            $phone = "";
                                    @endphp
                                        <input type="text" name="phone" id="phone" required min="3" max="30" value="{{$phone}}" placeholder="Enter phone" />
                                    @php
                                    if(old('date_of_birth'))
                                        $date_of_birth = date('m/d/Y',strtotime(old('date_of_birth')));
                                    elseif(isset($user))
                                        $date_of_birth = isset($user->date_of_birth) ? date('m/d/Y',strtotime($user->date_of_birth)) : null;
                                    else
                                        $date_of_birth = null;
                                    @endphp
                                        <input type="text" placeholder="Birth Date" name="date_of_birth" id="date_of_birth" value="{{ $date_of_birth }}"  />
                                    @php
                                    if(old('address'))
                                        $address = old('address');
                                    elseif(isset($user))
                                        $address = isset($user->address) ? $user->address : '';
                                    else
                                        $address = "";
                                    @endphp
                                        <textarea name="address" id="address" placeholder="Enter address" required>{{$address}}</textarea>
                                    @php
                                    if(old('zip_code'))
                                        $zip_code = old('zip_code');
                                    elseif(isset($user))
                                        $zip_code = isset($user->zip_code) ? $user->zip_code : '';
                                    else
                                        $zip_code = "";
                                    @endphp
                                        <input type="text" name="zip_code" id="zip_code" value="{{$zip_code}}" placeholder="Zip code" minlength="5" maxlength="9" required/>
                                    <button type="submit" class="site-btn">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->
@endsection
@push('scripts')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
    $('#date_of_birth').datepicker({  
       format: 'mm/dd/yyyy'
     });  
</script>
@endpush