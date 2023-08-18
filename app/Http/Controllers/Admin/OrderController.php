<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\Builder;

class OrderController extends Controller
{
    private string $routeResourceName = 'order';

    public function __construct() {
        $this->middleware('can:view order')->only('index');
        $this->middleware('can:create order')->only(['create', 'store']);
        $this->middleware('can:edit order')->only(['edit', 'update']);
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
                'payment_method',
                'payment_status',
                'order_status',
            ])
            ->when(Request::input('id'), fn (Builder $builder, $id) => $builder->where('ulid', 'like', "%{$id}%"))
            ->when(Request::input('customer_name'), fn (Builder $builder, $customer_name) => $builder->where('customer_name', 'like', "%{$customer_name}%"))
            ->when(Request::input('customer_email'), fn (Builder $builder, $customer_email) => $builder->where('customer_email', 'like', "%{$customer_email}%"))
            ->when(Request::input('customer_phone'),
            fn (Builder $builder, $customer_phone) => $builder->where('customer_phone', 'like', "%{$customer_phone}%"))
            ->when(
                Request::input('status') !== null,
                fn (Builder $builder) => $builder->when(
                    Request::input('status') == true ?
                    fn (Builder $builder) => $builder->active() :
                    fn (Builder $builder) => $builder->inActive()
                )
            )
            ->when(
                Request::input('featured') !== null,
                fn (Builder $builder) => $builder->when(
                    Request::input('featured') == true ?
                    fn (Builder $builder) => $builder->featured() :
                    fn (Builder $builder) => $builder->notFeatured()
                )
            )
            ->when(
                Request::input('slider') !== null,
                fn (Builder $builder) => $builder->when(
                    Request::input('slider') == true ?
                    fn (Builder $builder) => $builder->onSlider() :
                    fn (Builder $builder) => $builder->noSlider()
                )
            )
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

            return Inertia::render('Admin/Menu/Index', [
                'title' => 'Orders',
                'filters' => Request::only(['name', 'categoryId', 'active', 'featured', 'slider']),
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
                        'label' => 'Payment Method',
                        'name' => 'payment_method'
                    ],
                    [
                        'label' => 'Payment Status',
                        'name' => 'payment_status'
                    ],
                    [
                        'label' => 'Order Status',
                        'name' => 'order_status'
                    ],
                    [
                        'label' => 'Action',
                        'name' => 'action'
                    ]
                ],
                'routeResourceName' => $this->routeResourceName,
                'can' => [
                    'manager' => Request::user()->can('create order'),
                    'edit' => Request::user()->can('edit order'),
                    'delete' => Request::user()->can('delete order'),
                ],
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }
}
