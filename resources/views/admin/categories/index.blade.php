@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">

                <div class="col-md-11"><h6 class="m-0 font-weight-bold text-primary">Category List</h6></div>
                <div class="col-md-1"><a class="pull-left" href="{{route('admin.categories.create') }}" ><i class="fas fa-plus fa-2x text-primary-300"></i></a></div>
            </div>
        </div>
        <div class="card-body">
            @if($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <table class="table">
                <thead>
                    <th>Gender</th>
                    <th>Category Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                    <tr>
                        <td>{{ Config::get('constants.gender')[$category->gender] }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ Str::limit($category->description,100,'...') }}</td>
                        <td>{{ $category->status == 1 ? "Active" : "Deactive" }}</td>
                        <td>
                            <form action="{{ route('admin.categories.destroy',Crypt::encrypt($category->id)) }}" method="POST">
                                @csrf
                                @method('DELETE')   
                                <a href="{{route('admin.categories.edit', Crypt::encrypt($category->id)) }}">Edit</a> |<button type="submit" class="btn btn-link">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                        <tr><td colspan="4" align="center">No categories found!</td></tr>
                    @endforelse
                </tbody>
            </table>
            {{ $categories->links() }}
        </div>
    </div>
</div>
@endsection