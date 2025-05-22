@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>{{ isset($product) ? 'Edit Product' : 'Add New Product' }}</h1>
    <form action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name ?? '' }}">
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ $product->description ?? '' }}</textarea>
        </div>
        <div class="mb-3">
            <label>Price</label>
            <input type="number" name="price" class="form-control" value="{{ $product->price ?? '' }}">
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</div>
@endsection
