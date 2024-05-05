@extends('dashboard.layouts.main')

@section('container')
<div class="container">
    <div class="row my-3">
        <div class="col-lg-8">
            <<h1>Delivery Orders</h1>
            <div class="mb-3">
                <a href="/dashboard/orders" class="btn btn-primary">All Orders</a>
                <a href="/dashboard/orders?status=draft" class="btn btn-info">Draft Orders</a>
                <a href="/dashboard/orders?status=needapproval" class="btn btn-warning">Need Approval Orders</a>
                <a href="/dashboard/orders?status=approve" class="btn btn-success">Approve</a>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Order Number</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Catatan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @dd($orders) --}}
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->nomerorder }}</td>
                            <td>Rp. {{ number_format($order->ordertotal, 0, ',', '.') }}</td>
                            <td>{{ $order->status }}</td>
                            <td>{{ $order->addcatatan }}</td>
                            <td>
                                <a href="/dashboard/orders/{{$order->id }}" class="btn btn-primary">View</a>
                                @if (in_array($order->status, ['draft', 'revisi', 'reject']))
                                <form action="/dashboard/orders/{{$order->id }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
</div>
@endsection
