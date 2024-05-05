<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\products;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = Cart::where('deleted', 'no')->get();
        $subtotal = $carts->sum('total');
        return view('dashboard.carts.index', compact('carts', 'subtotal'));
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
        $product = products::findOrFail($request->product_id);

        Cart::create([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'total' => $request->quantity * $product->product_price, // Hitung total berdasarkan harga produk
        ]);

        // Simpan data baru ke dalam database


        // Redirect ke halaman indeks atau halaman lain
        return redirect('/dashboard/carts')->with('success','Product Has Been Updated!');
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
    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->update(['deleted' => 'yes']);

        return redirect('/dashboard/carts')->with('success','product Has Been Deleted!');
    }

    public function drop()
    {
        // Set semua item di keranjang sebagai soft deleted
        Cart::where('deleted', 'no')->update(['deleted' => 'yes']);

        // Redirect kembali ke halaman keranjang dengan pesan sukses
        return redirect('/dashboard/carts')->with('success', 'All items have been soft deleted from the cart!');
    }
}
