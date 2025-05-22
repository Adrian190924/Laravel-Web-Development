<div class="card mb-2">
    <div class="card-body">
        <h5 class="card-title">{{ $product->name }}</h5>
        <p class="card-text">{{ $product->description }}</p>
        <p class="card-text"><strong>${{ $product->price }}</strong></p>
        <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm">Show</a>
        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
    </div>
</div>