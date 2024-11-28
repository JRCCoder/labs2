<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class PaymentStatusController extends Controller
{
    public function index()
    {
        $orders = Order::all(); // Fetch all orders for payment status
        return view('admin.payment_status.index', compact('orders'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'payment_status' => 'required|in:pending,paid,failed',
        ]);

        $order->update(['payment_status' => $request->payment_status]);

        return redirect()->route('admin.payment_status.index')->with('success', 'Payment status updated successfully.');
    }

    public function feedback(Request $request, Order $order)
    {
        $request->validate([
            'feedback' => 'required|string|max:1000',
        ]);

        // Save feedback logic here (e.g., save to a feedback table or send an email)

        return redirect()->route('admin.payment_status.index')->with('success', 'Feedback submitted successfully.');
    }
}

