@extends('dashboard.layouts.main')

@section('container')
<div class="container">
    <div class="row my-3">
        <div class="col-lg-8">
            {{-- {{ dd($carts) }} --}}

            {{-- <h1 class="mb-3">{{  $carts->product_name}}</h1> --}}

            {{-- @if ($carts->category)
            <div style="max-height: 350px; overflow:hidden">
                <img src="{{ asset('storage/' . $carts->image) }}" class="img-fluid mt-3"
                alt="{{ $carts->category->name }}">
            </div>
            @else
            <img src="https://source.unspLash.com/1200x400/?{{ $carts->category->product_category_name }}" class="img-fluid mt-3"
                alt="{{ $carts->category->product_category_name }}">
            @endif --}}

                {{-- <p class="card-text mb-0">{{ $carts->product_detail }}</p>
                <p class="card-text mb-0">{{ $carts->category->product_category_name }}</p>
                <p class="card-text">Rp {{ $carts->product_price }}</p> --}}

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <a href="{{ url('/dashboard') }}" class="btn btn-primary">Add Item to Cart</a>
                    <form action="{{ route('carts.drop') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <button type="submit" class="btn btn-danger">Clear Cart</button>
                    </form>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            {{-- <th>ID</th> --}}
                            <th>Product Name</th>
                            <th>Length</th>
                            <th>Width</th>
                            <th>Height</th>
                            <th>Weight</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carts as $cart)
                            <tr>
                                <td>{{ $cart->product->product_name }}</td>
                                <td>{{ $cart->product->product_length }}</td>
                                <td>{{ $cart->product->product_width }}</td>
                                <td>{{ $cart->product->product_height }}</td>
                                <td>{{ $cart->product->product_weight }}</td>
                                <td>{{ $cart->product->product_price }}</td>
                                <td>{{ $cart->quantity }}</td>
                                <td>{{ $cart->total }}</td>
                                <td>
                                    <form action="{{ route('carts.destroy', $cart->id) }}" method="POST" style="display: inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="4">Subtotal</td>
                            <td>{{ $subtotal }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="4">Diskon</td>
                            <td>
                                <input type="number" name="discount" id="discount" value="0">
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="4">Total</td>
                            <td>{{ $subtotal }}</td>
                            <td>
                                <a href="/dashboard/checkout" class="btn btn-success btn-sm float-end">Checkout</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <a href="/dashboard" class="btn btn-success mt-5 d-grid gap-2 d-md-block"><span data-feather="arrow-left"></span> Back To All Product</a>
        </div>
    </div>
</div>

@endsection



