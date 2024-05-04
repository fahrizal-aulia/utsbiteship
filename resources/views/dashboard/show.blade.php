@extends('dashboard.layouts.main')

@section('container')
<div class="container">
    <div class="row my-3">
        <div class="col-lg-8">
            {{-- {{ dd($product) }} --}}

            <h1 class="mb-3">{{  $product->product_name}}</h1>

            <a href="/dashboard" class="btn btn-success"><span data-feather="arrow-left"></span> Back To All Product</a>
            {{-- <a href="/dashboard/products/{{ $product->slug }}/edit" class="btn btn-warning"><span data-feather="edit"></span> Edit</a> --}}
            <form action="/dashboard/products/{{ $product->id }}" method="product" class="d-inline">
                @method('delete')
                @csrf
                <button class="btn btn-danger " onclick="return confirm('Yakin Mengahpus data ini?!!')"><span
                    data-feather="x-circle"></span>Delete</button>
            </form>
            {{-- @if ($product->category)
            <div style="max-height: 350px; overflow:hidden">
                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid mt-3"
                alt="{{ $product->category->name }}">
            </div>
            @else
            <img src="https://source.unspLash.com/1200x400/?{{ $product->category->product_category_name }}" class="img-fluid mt-3"
                alt="{{ $product->category->product_category_name }}">
            @endif --}}
            <div class="my-3 fs-5">
                <p class="card-text mb-0">{{ $product->product_detail }}</p>
                <p class="card-text">Rp {{ $product->product_price }}</p>
            </div>


        </div>
    </div>
</div>

@endsection



