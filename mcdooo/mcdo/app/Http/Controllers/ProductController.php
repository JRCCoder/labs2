<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Catalog;
use App\Models\StockHistory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('catalog')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $catalogs = Catalog::all();
        return view('admin.products.create', compact('catalogs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image',
            'catalog_id' => 'required|exists:catalogs,id',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
        ]);

        Product::create($request->all());

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $catalogs = Catalog::all();
        return view('admin.products.edit', compact('product', 'catalogs'));
    }

    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'product_name' => 'required|string|min:3|max:255|unique:products,product_name,' . $product->id,
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'catalog_id' => 'required|exists:catalogs,id',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $validatedData['image'] = $imageName;

            if ($product->image && file_exists(public_path('images/' . $product->image))) {
                unlink(public_path('images/' . $product->image));
            }
        }

        if (!isset($validatedData['description'])) {
            $validatedData['description'] = '';
        }

        $product->update($validatedData);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        if ($product->image && file_exists(public_path('images/' . $product->image))) {
            unlink(public_path('images/' . $product->image));
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    public function adminIndex(Request $request)
    {
        $catalogId = $request->get('catalog');
        $products = Product::when($catalogId, function ($query) use ($catalogId) {
            return $query->where('catalog_id', $catalogId);
        })->get();

        $catalogs = Catalog::all();
        return view('admin.products.index', compact('products', 'catalogs'));
    }

    public function adminCreate()
    {
        $catalogs = Catalog::all();
        return view('admin.products.create', compact('catalogs'));
    }

    public function adminStore(Request $request)
    {
        $validatedData = $request->validate([
            'product_name' => 'required|string|min:3|max:255|unique:products',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'catalog_id' => 'required|exists:catalogs,id',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $validatedData['image'] = $imageName;
        }

        if (!isset($validatedData['description'])) {
            $validatedData['description'] = '';
        }

        Product::create($validatedData);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function adminEdit(Product $product)
    {
        $catalogs = Catalog::all();
        return view('admin.products.edit', compact('product', 'catalogs'));
    }

    public function adminUpdate(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'product_name' => 'required|string|min:3|max:255|unique:products,product_name,' . $product->id,
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'catalog_id' => 'required|exists:catalogs,id',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $validatedData['image'] = $imageName;

            if ($product->image && file_exists(public_path('images/' . $product->image))) {
                unlink(public_path('images/' . $product->image));
            }
        }

        if (!isset($validatedData['description'])) {
            $validatedData['description'] = '';
        }

        $product->update($validatedData);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function adminDestroy(Product $product)
    {
        if ($product->image && file_exists(public_path('images/' . $product->image))) {
            unlink(public_path('images/' . $product->image));
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }

    public function addStock(Request $request, $id)
    {
        $request->validate([
            'stock' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($id);
        $product->stock += $request->input('stock');
        $product->save();

        // Create a stock history record
        StockHistory::create([
            'product_id' => $product->id,
            'quantity' => $request->input('stock'),
            'action' => 'added',
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Stock added successfully.');
    }

    public function showStockHistory($id)
    {
        $product = Product::with('stockHistories')->findOrFail($id);
        return view('admin.products.stock_history', compact('product'));
    }
}
