<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items')->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'payment_status' => 'required|in:pending,paid,failed',
            'shipping_status' => 'required|in:pending,shipped,delivered',
        ]);

        $order->update($request->only(['payment_status', 'shipping_status']));

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }

    public function adminIndex(Request $request)
    {
        $query = Order::with('user')->orderBy('created_at', 'desc');

        if ($request->has('status')) {
            $query->where('shipping_status', $request->status);
        }

        $orders = $query->paginate(20);
        return view('admin.orders.index', compact('orders'));
    }

    public function adminShow(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    public function updateShippingStatus(Request $request, Order $order)
    {
        $request->validate([
            'shipping_status' => 'required|in:pending,shipped,delivered',
        ]);

        $order->update(['shipping_status' => $request->shipping_status]);

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }

    public function report(Request $request)
    {
        dd('Report method called'); // This will dump and die, showing this message if the method is reached
        
        $completedOrders = Order::where('shipping_status', 'delivered')->get();
        return view('admin.orders.report', compact('completedOrders'));
    }

    public function customerOrders(Request $request)
    {
        $orders = Order::where('user_id', auth()->id())->with('items')->latest()->paginate(10);
        return view('orders.customer_orders', compact('orders'));
    }

    public function submitFeedback(Request $request, Order $order)
    {
        $request->validate([
            'feedback' => 'required|string|max:1000',
        ]);

        // Save feedback logic here (e.g., save to a feedback table or send an email)

        return redirect()->route('customer.orders')->with('success', 'Feedback submitted successfully.');
    }
    
}
