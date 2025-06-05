<div class="card shadow-sm h-100 border-0">
    <div class="card-body d-flex flex-column justify-content-between">
        <div>
            <h5 class="card-title fw-bold text-primary">{{ $product->name }}</h5>
            <p class="card-text text-muted small">{{ $product->description }}</p>
        </div>
        <div class="mt-2">
            <span class="badge bg-secondary mb-2">{{ $product->category->name }}</span>
            <h6 class="text-success fw-semibold">${{ $product->price }}</h6>
        </div>
        <div class="mt-3">
            <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-info btn-sm">View</a>
            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-outline-warning btn-sm">Edit</a>
            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Delete this product?');">Delete</button>
            </form>
        </div>
    </div>
</div>