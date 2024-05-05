<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;

class ApiOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Mendapatkan status dari permintaan
    $status = $request->input('status');

    // Query dasar
    // $query = Order::query();
    $query = Orders::query()->where('deleted', 'false');

    // Filter berdasarkan status
    if ($status) {
        $query->where('status', $status);
    }
    else
    {
        $query->where('status', '!=', 'approve');
    }

    // Mendapatkan data order sesuai dengan filter
    $orders = $query->get();

    return response()->json($orders);
    }


    public function show(Orders $order)
    {
        return response()->json($order);
    }

    public function approve($id)
    {
        $order = Orders::findOrFail($id);
        $order->update(['status' => 'approve']);
        $order->update([
            'status' => 'approve',
            'addcatatan' => '-'
        ]);

        return response()->json(['message' => 'Order has been approved']);
    }

    public function reject(Request $request, $id)
    {
        $order = Orders::findOrFail($id);
        $order->update([
            'status' => 'reject',
            'addcatatan' => $request->input('reason_status')
        ]);

        return response()->json(['message' => 'Order has been rejected']);
    }

    public function revisi(Request $request, $id)
    {
        $order = Orders::findOrFail($id);
        $order->update([
            'status' => 'revisi',
            'addcatatan' => $request->input('reason_status')
        ]);

        return response()->json(['message' => 'Order needs revision']);
    }
}
