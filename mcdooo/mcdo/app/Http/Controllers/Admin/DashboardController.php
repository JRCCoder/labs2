<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalProducts = Product::count();
        $pendingOrders = Order::where('shipping_status', 'pending')->count();
        $monthlyRevenue = Order::whereMonth('created_at', Carbon::now()->month)
                               ->whereYear('created_at', Carbon::now()->year)
                               ->sum('total_amount');

        return view('admin.dashboard', compact('totalProducts', 'pendingOrders', 'monthlyRevenue'));
    }
}