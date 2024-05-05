@extends('dashboard.layouts.main')

@section('container')
<div class="container">
    <div class="row my-3">
        <div class="col-lg-8">
            <h1 class="my-4">Check Delivery Order</h1>

        <div class="row">
            <div class="col-md-4">
                <h2>Order Information</h2>
                {{-- @dd($order) --}}
                <ul class="list-group">
                    <li class="list-group-item"><strong>Nomor Order:</strong> {{ $order['nomerorder'] }}</li>
                    <li class="list-group-item"><strong>Item Subtotal:</strong> {{ $order['itemsub_total'] }}</li>
                    <li class="list-group-item"><strong>Tax:</strong> {{ $order['tax'] }}</li>
                    <li class="list-group-item"><strong>Shipping Price:</strong> {{ $order['shipping_price'] }}</li>
                    <li class="list-group-item"><strong>Order Total:</strong> {{ $order['ordertotal'] }}</li>
                    <li class="list-group-item"><strong>Pengiriman:</strong> {{ $order['pengiriman'] }}</li>
                    <li class="list-group-item"><strong>Nama Lengkap:</strong> {{ $order['namalengkap'] }}</li>
                    <li class="list-group-item"><strong>Alamat:</strong> {{ $order['alamat'] }}</li>
                    <li class="list-group-item"><strong>Kode Pos:</strong> {{ $order['kodepos'] }}</li>
                    <li class="list-group-item"><strong>Email:</strong> {{ $order['email'] }}</li>
                    <li class="list-group-item"><strong>Phone:</strong> {{ $order['phone'] }}</li>
                    <li class="list-group-item"><strong>Add Catatan:</strong> {{ $order['addcatatan'] }}</li>
                    <li class="list-group-item"><strong>Status:</strong> {{ $order['status'] }}</li>
                </ul>
            </div>
            <div class="col-md-8">
                <h2>Order Detail</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Value</th>
                            <th>Length</th>
                            <th>Width</th>
                            <th>Height</th>
                            <th>Weight</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carts as $cart)
                            <tr>
                                <td>{{ $cart->product->product_name }}</td>
                                <td>{{ $cart->product->product_detail }}</td>
                                <td>{{ $cart->product->product_price }}</td>
                                <td>{{ $cart->product->product_length }}</td>
                                <td>{{ $cart->product->product_width }}</td>
                                <td>{{ $cart->product->product_height }}</td>
                                <td>{{ $cart->product->product_weight }}</td>
                                <td>{{ $cart->quantity }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('checkout.saveDraft') }}" method="POST" class="d-inline-block">
                    @csrf
                    <input type="hidden" name="order" value="{{ json_encode($order) }}">
                    <input type="hidden" name="orderDetails" value="{{ json_encode($orderDetails) }}">
                    <button type="submit" class="btn btn-primary mr-2">Simpan Draft</button>
                </form>
                <form action="{{ route('checkout.submitApproval') }}" method="POST" class="d-inline-block">
                    @csrf
                    <input type="hidden" name="order" value="{{ json_encode($order) }}">
                    <input type="hidden" name="orderDetails" value="{{ json_encode($orderDetails) }}">
                    <button type="submit" class="btn btn-success">Ajukan Persetujuan</button>
                </form>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection

