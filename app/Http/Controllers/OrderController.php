<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreOrderRequest;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\UpdateOrderRequest;
use App\Notifications\NewOrderNotification;

class OrderController extends Controller
{
    /**
     * Display checkout page.
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
        $data = $request->safe()->only(['customer_name', 'customer_email', 'customer_phone', 'amount', 'tx_ref', 'payment_method', 'cart']);
        $data['payment_status'] = 1;
        $data['order_status'] = 1;

        $order = Order::create($data);

        $order->notify(new NewOrderNotification($order));

        if ($request->payment_method == 1 && $request->tx_ref !== '') {
            PaymentController::confirmPaymentStatus($request->tx_ref);
        }
        return Redirect::route('frontend.order.confirmation', [
            'order' => $order->ulid
        ])->with('success', 'Your Order Has Been Placed');
    }

        /**
     * Display a order confirmation page.
     */
    public function confirmation(Order $order)
    {
        if ($order->order_status == 0) {
            $status = 'has been cancelled';
        } elseif ($order->order_status == 1) {
            $status = 'is been processed';
        } elseif ($order->order_status == 2) {
            $status = 'is ready for pickup';
        } else {
            $status = 'has been picked up';
        }

        return Inertia::render('Frontend/CheckoutSuccess', [
            'title' => 'Order Confirmation',
            'orderId' => $order->ulid,
            'orderStatus' => $status,
        ]);
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
