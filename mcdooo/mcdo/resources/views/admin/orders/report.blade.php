@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Sales Report</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Order Date</th>
                <th>Total Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($completedOrders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user->name }}</td>
                <td>{{ $order->created_at->format('Y-m-d H:i:s') }}</td>
                <td>₱{{ number_format($order->total_amount, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        <h3>Total Sales: ₱{{ number_format($completedOrders->sum('total_amount'), 2) }}</h3>
    </div>

    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Back to Orders</a>
</div>
@endsection
