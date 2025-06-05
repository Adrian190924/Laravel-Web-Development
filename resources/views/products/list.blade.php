@extends('layouts.app')

@section('content')
<div class="container py-5 bg-light rounded shadow-sm">
    <h1 class="mb-4 text-center"><i class="bi bi-box-seam"></i> Product List</h1>

    {{-- Search, Filter, Sort --}}
    <div class="card p-4 mb-4 shadow-sm">
        <form action="{{ route('products.index') }}" method="GET" class="mb-4" id="filterSortForm">
            <div class="row g-3 align-items-end">

                {{-- Search Feature --}}
                <div class="col-md-4">
                    <label for="search" class="form-label">Search Product</label>
                    <div class="input-group">
                        <input type="text" name="search" id="search" class="form-control" placeholder="Search by name or description..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>

                {{-- Filter Feature --}}
                <div class="col-md-4">
                    <label class="form-label">Price Range</label>
                    <div class="input-group">
                        <input type="number" name="min_price" class="form-control" placeholder="Min" step="0.01" value="{{ request('min_price') }}">
                        <input type="number" name="max_price" class="form-control" placeholder="Max" step="0.01" value="{{ request('max_price') }}">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>

                {{-- Sort Feature --}}
                <div class="col-md-4">
                    <label for="sort_by" class="form-label">Sort By</label>
                    <div class="input-group">
                        <select name="sort_by" id="sort_by" class="form-select">
                            <option value="">Default</option>
                            <option value="name_asc" {{ request('sort_by') == 'name_asc' ? 'selected' : '' }}>Name (A-Z)</option>
                            <option value="name_desc" {{ request('sort_by') == 'name_desc' ? 'selected' : '' }}>Name (Z-A)</option>
                            <option value="price_asc" {{ request('sort_by') == 'price_asc' ? 'selected' : '' }}>Price (Low to High)</option>
                            <option value="price_desc" {{ request('sort_by') == 'price_desc' ? 'selected' : '' }}>Price (High to Low)</option>
                            <option value="created_at_desc" {{ request('sort_by') == 'created_at_desc' ? 'selected' : '' }}>Newest First</option>
                            <option value="created_at_asc" {{ request('sort_by') == 'created_at_asc' ? 'selected' : '' }}>Oldest First</option>
                        </select>
                    </div>
                </div>

                {{-- Clear Filters --}}
                <div class="col-12 d-flex justify-content-end mt-2">
                    @if(request('search') || request('min_price') || request('max_price') || request('sort_by'))
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">Clear All Filters</a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    {{-- Add Product --}}
    <a href="{{ route('products.create') }}" class="btn btn-primary mb-4"><i class="bi bi-plus-circle"></i> Add New Product</a>

     {{-- Success/Error Messages Display --}}
     @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    {{-- Product List --}}
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse($products as $product)
            <div class="col">
                <x-product-card :product="$product" />
            </div>
        @empty
            <div class="col-12">
                <p>No products found.</p>
            </div>
        @endforelse
    </div>
</div>

{{-- JavaScript Auto Sort --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sortBySelect = document.getElementById('sort_by');
        const filterSortForm = document.getElementById('filterSortForm');

        if (sortBySelect && filterSortForm) {
            sortBySelect.addEventListener('change', function() {
                filterSortForm.submit();
            });
        }
    });
</script>
@endsection