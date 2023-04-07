<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Order::paginate($request->limit);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return Response::api('Order retrieved', $order);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return Response::api('Order deleted');
    }
}
