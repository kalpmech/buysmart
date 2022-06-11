@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-11"><h6 class="m-0 font-weight-bold text-primary">Product List</h6></div>
                <div class="col-md-1"><a class="pull-left" href="{{route('admin.products.create') }}" ><i class="fas fa-plus fa-2x text-primary-300"></i></a></div>
            </div>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <th>Category Name</th>
                    <th>Added By</th>
                    <th>Product Name</th>
                    <th>Size</th>
                    <th>Brand</th>
                    <th>Status</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->category->name  ?? 'None' }}</td>
                        <td>{{ $product->user->full_name ?? 'None' }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->size }}</td>
                        <td>{{ $product->brand }}</td>
                        <td>{{ $product->status == 1 ? "Active" : "Deactive" }}</td>
                        <td>
                            <form action="{{ route('admin.products.destroy',Crypt::encrypt($product->id)) }}" method="POST">
                                @csrf
                                @method('DELETE')   
                                <a href="{{ route('admin.products.edit',Crypt::encrypt($product->id)) }}">Edit</a> | <button type="submit" class="btn btn-link">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection