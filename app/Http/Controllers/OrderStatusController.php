<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateOrderStatusRequest;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderStatusController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(OrderStatus::class, 'orderStatus');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return OrderStatus::paginate($request->limit);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return Response::api('Order status created',
            OrderStatus::create($request->validate([
                'title' => 'required|unique:order_statuses'
            ]))
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderStatus $orderStatus)
    {
        return Response::api('Order status retrieved', $orderStatus);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderStatusRequest $request, OrderStatus $orderStatus)
    {
        $orderStatus->update($request->validated());

        return Response::api('Order status updated', $orderStatus);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderStatus $orderStatus)
    {
        $orderStatus->delete();

        return Response::api('Order status deleted');
    }
}
