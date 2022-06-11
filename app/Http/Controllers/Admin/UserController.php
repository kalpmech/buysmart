<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(15);
        return View::make('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('admin.users.add-edit-user');
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
            "first_name" => "required|min:2|max:191|string",
            "last_name" => "required|min:2|max:191|string",
            "last_name" => "required|min:2|max:191|string|unique:users,email,NULL,id,deleted_at,NULL",
            "phone" => "required|min:10|max:10",
            "zip_code" => "required|min:4",
            "date_of_birth" => "required|date",
            "address" => "required|min:2|max:191",
            "user_type" => "required",
            "status" => "required|integer|in:0,1",
            "avatar" => "nullable|image|mimes:jpeg,png,jpg|max:5120",
        ]);

        $user = new User();

        if($request->hasFile('avatar')){
            $request->avatar->store('users', 'public');
            $user->avatar = $request->avatar->hashName();
        }


        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->zip_code = $request->zip_code;
        $user->date_of_birth = $request->date_of_birth;
        $user->phone = $request->phone;
        $user->password = Hash::make('Test123#');
        $user->status = $request->status;
        $user->save();

        return redirect()->route('admin.users.index')->with('success','User created successfully!');
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
        $user = User::find(Crypt::decrypt($id));
        return View::make('admin.users.add-edit-user',compact('user'));
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
        $user = User::find(Crypt::decrypt($id));
        $userId = $user->id;

        $request->validate([
            "first_name" => "required|min:2|max:191|string",
            "last_name" => "required|min:2|max:191|string",
            "last_name" => "required|min:2|max:191|string|unique:users,email,NULL,id,deleted_at,NULL".$userId,
            "phone" => "required|min:10|max:10",
            "zip_code" => "required|min:4",
            "date_of_birth" => "required|date",
            "address" => "required|min:2|max:191",
            "user_type" => "required",
            "status" => "required|integer|in:0,1",
            "avatar" => "nullable|image|mimes:jpeg,png,jpg|max:5120",
        ]);
      
        if($request->hasFile('avatar')){
            $request->avatar->store('users', 'public');
            $user->avatar = $request->avatar->hashName();
        }

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->zip_code = $request->zip_code;
        $user->date_of_birth = $request->date_of_birth;
        $user->phone = $request->phone;
        $user->user_type = $request->user_type;
        $user->status = $request->status;
        $user->save();
        
        return redirect()->route('admin.users.index')->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find(Crypt::decrypt($id));
        Storage::disk('public')->delete('users/'.$user->avatar);
        $user->delete();
        return redirect()->route('admin.users.index')->with('success','User deleted successfully');
    }
}
