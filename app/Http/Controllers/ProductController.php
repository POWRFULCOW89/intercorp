<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $products = Product::where('active', 1)
            ->when($search, function($query, $search) {
                return $query->where('name', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%");
            })
            ->paginate(10); // 10 products per page

        $header = 'Buscar';

        // Return the view with products and search term
        return view('products.index', compact('products', 'search', 'header'));
    }

    public function create()
    {
        // Create a new Product instance for the form
        $product = new Product();

        return view('admin.products.edit', compact('product'));
    }

    public function store(StoreProductRequest $request)
    {

        $validated = $request->validated();

        // Handle image upload if present
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    // Update method to edit an existing product
    public function update(UpdateProductRequest $request, $id)
    {
        $validated = $request->validated();

        $product = Product::findOrFail($id);

        // Handle image upload if present
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }

    public function adminIndex()
    {
        $products = Product::paginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function adminShow(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }
}
