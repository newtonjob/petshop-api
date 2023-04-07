<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Payment::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Payment::paginate($request->limit);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentRequest $request)
    {
        return Response::api('Payment created', Payment::create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        return Response::api('Payment retrieved', $payment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        $payment->update($request->validated());

        return Response::api('Payment updated', $payment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();

        return Response::api('Payment deleted');
    }
}
