<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller {
    public function index(Request $request) {
        $query = Product::query();

        // Search feature (Name or Description)
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function($q) use ($searchTerm) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($searchTerm) . '%'])
                  ->orWhereRaw('LOWER(description) LIKE ?', ['%' . strtolower($searchTerm) . '%']);
            });
        }

        // Filter by Price
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $minPrice);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $maxPrice);
        }

        // Sorting
        $sortBy = $request->input('sort_by');
        switch ($sortBy) {
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'created_at_desc': // Newest First
                $query->orderBy('created_at', 'desc');
                break;
            case 'created_at_asc': // Oldest First
                $query->orderBy('created_at', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $products = $query->get();
        return view('products.list', compact('products'));
    }

    public function create() {
        $categories = Category::all();
        return view('products.form', compact('categories'));
    }

    public function edit($id) {
        $product = Product::findorfail($id);
        $categories = Category::all();
        return view('products.form', compact('product','categories'));
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
        ]);

        Product::create($validatedData);
        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    public function update(Request $request, $id) {
        $product = Product::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product->update($validatedData);
        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    public function show($id) {
        $product = Product::findorfail($id);
        return view('products.show', compact('product'));
    }

    public function destroy($id) {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}
