@extends('dashboard.layouts.main')

@section('container')
<div class="container">
    <div class="row my-3">
        <div class="col-lg-8">
            {{-- {{ dd($product) }} --}}

            <h1 class="mb-3">Detail Produk</h1>

            {{-- @if ($product->category)
            <div style="max-height: 350px; overflow:hidden">
                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid mt-3"
                alt="{{ $product->category->name }}">
            </div>
            @else
            <img src="https://source.unspLash.com/1200x400/?{{ $product->category->product_category_name }}" class="img-fluid mt-3"
                alt="{{ $product->category->product_category_name }}">
            @endif --}}

                {{-- <p class="card-text mb-0">{{ $product->product_detail }}</p>
                <p class="card-text mb-0">{{ $product->category->product_category_name }}</p>
                <p class="card-text">Rp {{ $product->product_price }}</p> --}}

                <div class="product-details my-3 fs-5">
                    <h2>{{ $product->product_name }}</h2>
                    <p>SKU: {{ $product->sku }}</p>
                    <p>Category: {{ $product->category->product_category_name }}</p>
                    <p>Brand: {{ $product->brands->product_brand }}</p>
                    <p>Price: Rp. {{ $product->product_price }}</p>
                    <p>Status: {{ $product->status }}</p>
                    <p>Description: {{ $product->product_detail }}</p>
                    <form action="/dashboard/carts" method="POST" enctype="multipart/form-data" class="add-to-cart-form">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="mb-2" for="quantity">Quantity:</label>
                            <input type="number" id="quantity" name="quantity" value="1" min="1">
                        </div>
                        <div class="form-group mb-3">
                            <label class="mb-2" for="user_id">User ID:</label>
                            <input type="text" name="user_id" value="1">
                        </div>
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                    </form>
                </div>

                <a href="/dashboard" class="btn btn-success mt-5 d-grid gap-2 d-md-block"><span data-feather="arrow-left"></span> Back To All Product</a>
        </div>
    </div>
</div>

@endsection



