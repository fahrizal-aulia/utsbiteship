<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\OrderDetail;
use App\Models\Orders;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = Cart::where('deleted', 'no')->get();
        // Hitung subtotal
        $subtotal = $carts->sum('total');


        // Hitung subtotal
        $totalPrice = $carts->sum('total');
        return view('dashboard.checkout.index', compact('carts', 'subtotal', 'totalPrice'));
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
    // Generate nomor order
    $orderNumber = 'DO' . date('dmY') . $request->iduser;

    // Set data order
    $order = [
        'nomerorder' => $orderNumber,
        'iduser' => 1,
        'status' => 'draft',
        'itemsub_total' => $request->itemsub_total,
        'tax' => 0,
        'shipping_price' => $request->shipping_price,
        'ordertotal' => $request->itemsub_total + $request->shipping_price,
        'payment' => 0,
        'pengiriman' => $request->pengiriman,
        'namalengkap' => $request->namalengkap,
        'firstname' => $request->firstname,
        'lastname' =>$request->lastname,
        'negara' => $request->negara,
        'provinsi' => $request->provinsi,
        'kota' => $request->kota,
        'kecamatan' => $request->kecamatan,
        'alamat' => $request->alamat,
        'kodepos' => $request->post_destination_postal_code,
        'email' => "fahrizal@gmail.com",
        'phone' => $request->phone,
        'addcatatan' => "-",
        'payment_id' => "",
        'payment_method' => "",
        'payment_status' => "",
        'tracking_number' => "",
        'deleted' => 'no'
    ];


    $carts = Cart::where('deleted', 'no')->get();


    $orderDetails = $carts->map(function ($cart) use ($orderNumber) {
        return [
            'nomerorder' => $orderNumber,
            'idproduct' => $cart->product->id,
            'hargaproduk' => $cart->product->product_price,
            'qty' => $cart->quantity,
            'subtotalproduk' => $cart->total,
            'note' => "-",
            'review' => "-",
            'status' => 'active'
        ];
    });

    return view('dashboard.checkout.checkdo', compact('carts','order', 'orderDetails'));
}


    public function saveDraft(Request $request)
    {

        // Ambil data order dan order detail dari request
        $order = json_decode($request->order, true);
        $orderDetails = json_decode($request->orderDetails, true);
        // dd($order);
        // dd($orderDetails);
        // Simpan data order ke dalam database dengan status draft
        $newOrder = Orders::updateOrCreate(['nomerorder' => $order['nomerorder']], array_merge($order, ['status' => 'draft'],['deleted' => 'no']));
        foreach ($orderDetails as $detail) {
            OrderDetail::create($detail);
        }

         // Set semua item di keranjang sebagai soft deleted
        Cart::where('deleted', 'no')->update(['deleted' => 'yes']);

        // Set pesan sukses atau error jika diperlukan
        $message = "Draft berhasil disimpan";
        return redirect('/dashboard/orders')->with('success', $message);
    }

    public function submitApproval(Request $request)
    {

        //dd("approve");
        // Ambil data order dan order detail dari request
        $order = json_decode($request->order, true);
        $orderDetails = json_decode($request->orderDetails, true);

        // Simpan data order ke dalam database dengan status needapproval
        // $newOrder = Order::create(array_merge($order, ['status' => 'needapproval'],['deleted' => 'no']));
        $newOrder = Orders::updateOrCreate(['nomerorder' => $order['nomerorder']], array_merge($order, ['status' => 'needapproval'],['deleted' => 'no']));

        foreach ($orderDetails as $detail) {
            orderDetail::create($detail);
        }

         // Set semua item di keranjang sebagai soft deleted
        Cart::where('deleted', 'no')->update(['deleted' => 'yes']);

        // Set pesan sukses atau error jika diperlukan
        $message = "Pesanan berhasil diajukan untuk persetujuan";
        return redirect('/dashboard/orders')->with('success', $message);
        // Redirect atau kembalikan pesan sukses/error
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
