<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::all();
        return view('admin.vouchers.index', compact('vouchers'));
    }

    public function create()
    {
        return view('admin.vouchers.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'code' => 'required|unique:vouchers',
            'discount_amount' => 'required|numeric|min:0',
            'discount_type' => 'required|in:fixed,percentage',
            'valid_from' => 'required|date',
            'valid_until' => 'required|date|after:valid_from',
            'usage_limit' => 'nullable|integer|min:1',
            'is_active' => 'boolean',
        ]);

        if ($validatedData['discount_type'] === 'percentage') {
            $validatedData['discount_percentage'] = $validatedData['discount_amount'];
            $validatedData['discount_amount'] = 0; // Set a default value instead of null
        } else {
            $validatedData['discount_percentage'] = null;
        }

        Voucher::create($validatedData);

        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher created successfully.');
    }

    public function edit(Voucher $voucher)
    {
        return view('admin.vouchers.edit', compact('voucher'));
    }

    public function update(Request $request, Voucher $voucher)
    {
        $validatedData = $request->validate([
            'code' => 'required|unique:vouchers,code,' . $voucher->id,
            'discount_amount' => 'required|numeric|min:0',
            'discount_type' => 'required|in:fixed,percentage',
            'valid_from' => 'required|date',
            'valid_until' => 'required|date|after:valid_from',
            'usage_limit' => 'nullable|integer|min:1',
            'is_active' => 'boolean',
        ]);

        $voucher->update($validatedData);

        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher updated successfully.');
    }

    public function destroy(Voucher $voucher)
    {
        $voucher->delete();
        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher deleted successfully.');
    }
}
