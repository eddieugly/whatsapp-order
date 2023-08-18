<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Database\Eloquent\Builder;

class OrderController extends Controller
{
    private string $routeResourceName = 'orders';

    public function __construct() {
        $this->middleware('can:view order')->only('index');
        $this->middleware('can:create order')->only(['create', 'store']);
        $this->middleware('can:manage order')->only(['edit', 'update']);
        $this->middleware('can:delete order')->only('destroy');
    }
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders  = Order::query()
            ->select([
                'id',
                'ulid',
                'amount',
                'customer_name',
                'customer_email',
                'customer_phone',
                'cart',
                'addon',
                'tx_ref',
                'payment_status',
                'payment_method',
                'order_status',
                'created_at',
            ])
            ->when(Request::input('id'), fn (Builder $builder, $id) => $builder->where('ulid', 'like', "%{$id}%"))
            ->when(Request::input('name'), fn (Builder $builder, $name) => $builder->where('customer_name', 'like', "%{$name}%"))
            ->when(Request::input('email'), fn (Builder $builder, $email) => $builder->where('customer_email', 'like', "%{$email}%"))
            ->when(Request::input('phone'), fn (Builder $builder, $phone) => $builder->where('customer_phone', 'like', "%{$phone}%"))
            ->when(Request::input('payment_status') !== null,
                fn (Builder $builder) => $builder->when(
                    Request::input('payment_status') == 2 ?
                    fn (Builder $builder) => $builder->paymentCompleted() :
                    (Request::input('payment_status') == 1 ?
                    fn (Builder $builder) => $builder->paymentPending() :
                    fn (Builder $builder) => $builder->paymentFailed())
                )
            )
            ->when(Request::input('payment_method') !== null,
                fn (Builder $builder) => $builder->when(
                    Request::input('payment_method') == 1 ?
                    fn (Builder $builder) => $builder->payNow() :
                    fn (Builder $builder) => $builder->payOnPickup()
                )
            )
            ->when(Request::input('order_status') !== null,
                fn (Builder $builder) => $builder->when(
                    Request::input('order_status') == 3 ?
                    fn (Builder $builder) => $builder->orderPicked() :
                    (Request::input('order_status') == 2 ?
                    fn (Builder $builder) => $builder->orderCompleted() :
                    fn (Builder $builder) => $builder->orderPending())
                )
            )
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

            return Inertia::render('Admin/Order/Index', [
                'title' => 'Orders',
                'filters' => Request::only(['id', 'name', 'email', 'phone', 'payment_status', 'payment_method', 'order_status']),
                'items' => OrderResource::collection($orders),
                'headers' => [
                    [
                        'label' => 'Order Id',
                        'name' => 'id'
                    ],
                    [
                        'label' => 'Customer',
                        'name' => 'customer'
                    ],
                    [
                        'label' => 'Amount',
                        'name' => 'amount'
                    ],
                    [
                        'label' => 'Payment Status',
                        'name' => 'payment_status'
                    ],
                    [
                        'label' => 'Payment Method',
                        'name' => 'payment_method'
                    ],
                    [
                        'label' => 'Order Status',
                        'name' => 'order_status'
                    ],
                    [
                        'label' => 'View Order',
                        'name' => 'order_view'
                    ],
                    [
                        'label' => 'Action',
                        'name' => 'action'
                    ]
                ],
                'routeResourceName' => $this->routeResourceName,
                'can' => [
                    'manage' => Request::user()->can('manage order'),
                    'edit' => Request::user()->can('update order'),
                    'delete' => Request::user()->can('delete order'),
                ],
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        return Inertia::render('Admin/Order/Edit', [
            'title' => 'Update Order',
            'item' => new OrderResource($order),
            'routeResourceName' => $this->routeResourceName,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {

        $data = $request->safe()->only(['customer_name', 'customer_email', 'customer_phone', 'order_status']);

        $order->update($data);

        return Redirect::route('admin.orders.index')->with('success', 'Order Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return Redirect::back()->with('success', 'Order Deleted Successfully');
    }
}
