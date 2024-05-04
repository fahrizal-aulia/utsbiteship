@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Welcome back, {{ auth()->user()->name }}</h1>
</div>


<div class="container">
    <div class="row">
        @foreach($products as $product)
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="position-absolute  px-3 py-2 text-white" style="background-color: rgba(0,0,0,0.7)"><a
                        class="text-decoration-none text-white" >
                        {{ $product->category->product_category_name }}</a>
                </div>
                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid mt-3"
                    alt="{{ $product->category->product_category_name }}">
                @else
                {{-- <img src="https://source.unspLash.com/500x400/?{{ $product->category->product_category_name }}" class="card-img-top"
                    alt="{{ $product->category->product_category_name }}"> --}}
                @endif

                <div class="card-body">
                    <a class="text-decoration-none text-dark" href="/dashboard/product/{{ $product->id }}"><h5 class="card-title">{{ $product->product_name }}</h5></a>
                    <p class="card-text mb-0">{{ $product->product_detail }}</p>
                    <p class="card-text">Rp {{ $product->product_price }}</p>
                    <a href="/product/{{ $product->id }}" class="btn btn-primary float-end">masukan keranjang</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection