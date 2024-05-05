<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = $request->input('status');

        $query = Orders::query()->where('deleted', 'no');

        if ($status) {
            $query->where('status', $status);
        }

        $orders = $query->get();

        return view('dashboard.delivery.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Orders $order)
    {
        // dd($orders->id);
//         $order = Orders::findOrFail($order->id);
//         // $product = products::findOrFail($product->id);
//         $carts = DB::table('order_details as c')
//         ->join('products as p', 'c.idproduct', '=', 'p.id')
//         ->select('c.*', 'p.product_name', 'p.product_detail', 'p.product_price', 'p.product_length', 'p.product_width', 'p.product_height', 'p.product_weight')
//         ->where('c.deleted', 'no')
//         ->where('c.nomerorder', $order->nomerorder)
//         ->get();

// $orderDetails = [];

//         $orderDetails = [];

//         // Tampilkan detail pesanan
//         return view('dashboard.delivery.show', compact('carts','order', 'orderDetails'));

            $order = Orders::findOrFail($order->id);
            // $product = products::findOrFail($product->id);
            $carts =OrderDetail::with('product')->where('deleted', 'no')->where('nomerorder', $order->nomerorder)->get();
            $orderDetails = [];

            // Tampilkan detail pesanan
            return view('dashboard.delivery.show', compact('carts','order', 'orderDetails'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orders $orders)
    {
        $orders->update(['status' => 'approved']);
        return redirect('/dashboard/orders')->with('success','Produk Has Been approved!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Orders $orders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orders $order)
    {
        $order = Orders::findOrFail($order->id);

        // Hanya boleh dihapus jika status adalah 'revisi', 'reject', atau 'draft'
        if (in_array($order->status, ['revisi', 'reject', 'draft'])) {
            $order->update(['deleted' => 'yes']);
            return redirect('/dashboard/orders')->with('success', 'Order successfully deleted.');
        } else {
            return redirect('/dashboard/orders')->with('error', 'Order cannot be deleted because of its status.');
        }
    }
}
