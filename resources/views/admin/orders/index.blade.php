@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        Orders
        </div>
        <div class="card-body">
            @if($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <table class="table">
                <thead>
                    <th>#</th>
                    <th>Customer Name</th>
                    <th>Status</th>
                    <th>Payment Type</th>
                    <th>Order Amount</th>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->fullName }}</td>
                        <td>{{ $order->status }}</td>
                        <td>{{ $order->pay_type }}</td>
                        <td>${{ number_format($order->order_total,2) }}</td>
                    </tr>
                    @empty
                        <tr><td colspan="4" align="center">No Order found!</td></tr>
                    @endforelse
                </tbody>
            </table>
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection