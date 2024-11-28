<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Category;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index()
    {
        $catalogs = Catalog::all();
        return view('admin.catalogs.index', compact('catalogs'));
    }

    public function create()
    {
        $catalogs = Catalog::all();
        return view('admin.catalogs.create', compact('catalogs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        if (Catalog::where('name', $request->name)->exists()) {
            return redirect()->back()->withErrors(['name' => 'The catalog name already exists.']);
        }

        Catalog::create($request->all());

        return redirect()->route('admin.catalogs.index')->with('success', 'Catalog created successfully.');
    }

    public function edit(Catalog $catalog)
    {
        return view('admin.catalogs.edit', compact('catalog'));
    }

    public function update(Request $request, Catalog $catalog)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $catalog->update($request->all());

        return redirect()->route('admin.catalogs.index')->with('success', 'Catalog updated successfully.');
    }

    public function destroy(Catalog $catalog)
    {
        $catalog->delete();
        return redirect()->route('admin.catalogs.index')->with('success', 'Catalog deleted successfully.');
    }
}
