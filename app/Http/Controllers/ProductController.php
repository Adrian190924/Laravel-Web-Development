<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller {
    public function index() {
    //Display products, Simulate with a collection, Should fetch from DB
    $products = collect();
    for ($i = 1; $i <= 20; $i++) {
        $products->push((object)[
            'id' => $i,
            'name' => "Product $i",
            'description' => "Description for Product $i",
            'price' => rand(10, 100)
        ]);
    }
    return view('products.list', compact('products'));
    }

    public function create() {
        return view('products.form');
    }

    public function edit($id) {
        $product = (object)[
            'id' => $id,
            'name' => "Product $id",
            'description' => "Description for Product $id",
            'price' => rand(10, 100)
        ];
        return view('products.form', compact('product'));
    }

    public function store(Request $request) {
        // Should save to DB, Now just return back for testing
        return redirect()->route('products.index');
    }

    public function update(Request $request, $id) {
        return redirect()->route('products.index');
    }

    public function show($id) {
        $product = (object)[
            'id' => $id,
            'name' => "Product $id",
            'description' => "Description for Product $id",
            'price' => rand(10, 100)
        ];
        return view('products.show', compact('product'));
    }
}
