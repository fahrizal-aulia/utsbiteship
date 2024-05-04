@extends('dashboard.layouts.main')

@section('container')
<div class="container">
    <div class="row my-3">
        <div class="col-lg-8">
            <div class="mb-3">
                <!-- Deskripsi pengiriman -->
            </div>

            <!-- Form untuk memasukkan kode pos tujuan -->
            <div class="mb-3">
                <label for="destination_postal_code" class="form-label">Destination Postal Code:</label>
                <input type="text" class="form-control" id="destination_postal_code" name="destination_postal_code">
                <small id="postal_code_error" class="text-danger" style="display:none;">Postal code is empty!</small>
            </div>

            <!-- Tabel untuk menampilkan daftar barang yang dibeli -->
            <table class="table">
                <!-- Header tabel -->
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
                    <!-- Data barang -->
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

            <!-- Tempat untuk menampilkan harga pengiriman -->
            <div id="shipping_prices" class="mb-3">
                <!-- Daftar harga pengiriman akan ditampilkan di sini -->
            </div>

            <!-- Tombol untuk melanjutkan ke pembayaran -->
            <div class="mb-3" id="proceed_btn" style="display: none;">
                <form id="payment_form" action="" method="POST">
                    @csrf
                    <input type="hidden" name="itemsubtotal" value="{{ $totalPrice }}">
                    <input type="hidden" id="shipping_price_input" name="shippingprice" value="">
                    <input type="hidden" id="shipping_courier_input" name="pengiriman" value="">
                    <input type="hidden" id="post_destination_postal_code" name="post_destination_postal_code" value="">
                    <div id="shipping_price_options">
                        <!-- Tombol radio untuk memilih harga pengiriman -->
                    </div>
                    <button type="submit" class="btn btn-success mt-2">Check Delivery Order</button>
                </form>
            </div>

            <!-- Tombol untuk mendapatkan harga pengiriman -->
            <button type="button" id="get_shipping_btn" class="btn btn-primary mt-2" onclick="getShippingPrice()">Get Shipping</button>
        </div>
    </div>
</div>
@endsection

<script>
    function getShippingPrice() {
        var destinationPostalCode = document.getElementById("destination_postal_code").value.trim();

        if (destinationPostalCode === "") {
            displayErrorMessage("postal_code_error", true);
            return;
        } else {
            displayErrorMessage("postal_code_error", false);
        }

        document.getElementById("post_destination_postal_code").value = destinationPostalCode;

        var requestData = prepareRequestData(destinationPostalCode);
        fetchShippingPrices(requestData);
    }

    function displayErrorMessage(elementId, display) {
        var element = document.getElementById(elementId);
        element.style.display = display ? "block" : "none";
    }

    function prepareRequestData(destinationPostalCode) {
        var items = {!! $carts !!};
        var data = {
            "origin_postal_code": 61382,
            "destination_postal_code": destinationPostalCode,
            "couriers": "anteraja,jne,sicepat",
            "items": items.map(item => ({
                "name": item.product_name,
                "description": item.product_detail,
                "value": item.product_price,
                "length": item.product_length,
                "width": item.product_width,
                "height": item.product_height,
                "weight": item.product_weight,
                "quantity": item.quantity
            }))
        };
        return data;
    }

    function fetchShippingPrices(requestData) {
        fetch('https://api.biteship.com/v1/rates/couriers', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'biteship_test.eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1lIjoibW90YXNhLXRlc3QiLCJ1c2VySWQiOiI2NjIzNDg1NjY5NDBiZjAwMTIwMDk2MzIiLCJpYXQiOjE3MTM2NzU2MTl9.FdCJ4-rXa-xogujZ13U1OjIVMcHh9t8bo0oRXjcJLto'
            },
            body: JSON.stringify(requestData)
        })
        .then(response => response.json())
        .then(data => {
            displayShippingPrices(data);
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    }
    function displayShippingPrices(data) {
    var shippingPricesHtml = `<h2>Shipping Prices</h2>`;
    data.pricing.forEach((price, index) => {
        shippingPricesHtml += `
            <div class="form-check">
                <input class="form-check-input" type="radio" name="shipping_price" id="shipping_price_${index}" value="${price.price}" onclick="setShippingPrice(${price.price}, '${price.courier_name} - ${price.courier_service_name}')">
                <label class="form-check-label" for="shipping_price_${index}">
                    <strong>Courier Name:</strong> ${price.courier_name},
                    <strong>Courier Service Name:</strong> ${price.courier_service_name},
                    <strong>Duration:</strong> ${price.duration},
                    <strong>Price:</strong> ${price.price}
                </label>
            </div>`;
    });
    document.getElementById("shipping_prices").innerHTML = shippingPricesHtml;
    document.getElementById("proceed_btn").style.display = 'block';
    document.getElementById("get_shipping_btn").style.display = 'none';
}


    function setShippingPrice(price, courier) {
        document.getElementById("shipping_price_input").value = price;
        document.getElementById("shipping_courier_input").value = courier;
    }
</script>
