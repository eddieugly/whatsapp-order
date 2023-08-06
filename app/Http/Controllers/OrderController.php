<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function checkout()
    {
        return Inertia::render('Frontend/Checkout', [
            'title' => 'Checkout',
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function checkoutStore()
    {
        return Inertia::render('Frontend/Checkout', [
            'title' => 'Checkout',
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreOrderRequest $request)
    {
        $data = $request->safe()->only(['customer_name', 'customer_email', 'customer_phone', 'amount', 'payment_method', 'items']);

        $data['payment_status'] = 1;
        $data['order_status'] = 1;

        $order = Order::create($data);

        return response()->json($order);


    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
