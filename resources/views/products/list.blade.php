@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Product List</h1>
    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add new product</a>
    <ul class="list-group">
        @foreach($products as $product)
            <x-product-card :product="$product" />
        @endforeach
    </ul>
</div>
@endsection