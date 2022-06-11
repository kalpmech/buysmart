@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-11"><h6 class="m-0 font-weight-bold text-primary">Users List</h6></div>
                <div class="col-md-1"><a class="pull-left" href="{{route('admin.users.create') }}" ><i class="fas fa-plus fa-2x text-primary-300"></i></a></div>
            </div>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <th>Name</th>
                    <th>Email</th>
                    <th>User Type</th>
                    <th>Join Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->full_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst($user->user_type) }}</td>
                        <td>{{ $user->join_date }}</td>
                        <td>{{ $user->status == 1 ? "Active" : "Deactive" }}</td>
                        <td>
                            <form action="{{ route('admin.users.destroy',Crypt::encrypt($user->id)) }}" method="POST">
                                @csrf
                                @method('DELETE')   
                                <a href="{{ route('admin.users.edit',Crypt::encrypt($user->id)) }}">Edit</a> | <a href="{{ Crypt::encrypt($user->id) }}">Delete</a>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection