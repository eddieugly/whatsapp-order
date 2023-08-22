<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $total_orders_today = Order::whereDate('created_at', '=', date('Y-m-d'))->count();

        $pending_orders_today = Order::orderPending()->whereDate('created_at', '=', date('Y-m-d'))->count();

        $total_sales_today = Order::where('order_status', '!=', 0)->whereDate('created_at', '=', date('Y-m-d'))->sum('amount');

        $registered_customers_today = User::whereDate('created_at', '=', date('Y-m-d'))->count();

        $total_sales = Order::where('order_status', '!=', 0)->sum('amount');

        $active_categories = Category::active()->count();

        $active_menus = Menu::active()->count();

        $registered_customers = User::count();
        
        return Inertia::render('Admin/AdminDashboard', [
            'title' => 'Admin Dashboard',
            'total_orders_today' => $total_orders_today,
            'pending_orders_today' => $pending_orders_today,
            'total_sales_today' => $total_sales_today,
            'registered_customers_today' => $registered_customers_today,
            'total_sales' => $total_sales,
            'active_categories' => $active_categories,
            'active_menus' => $active_menus,
            'registered_customers' => $registered_customers,
        ]);
    }
}
