@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>{{ $product->name }}</h1>
    <p>{{ $product->description }}</p>
    <p>{{ $product->category_id }}</p>
    <p><strong>Price:</strong> ${{ $product->price }}</p>
</div>
@endsection
