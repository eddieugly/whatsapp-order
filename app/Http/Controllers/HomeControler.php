<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\MenuResource;
use App\Http\Resources\CategoryResource;
use Illuminate\Database\Eloquent\Builder;

class HomeControler extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $featured_categories = Category::whereHas('menus', function (Builder $query) {
            $query->where('status', true);
        })->active()
        ->featured()
        ->inRandomOrder()
        ->limit(3)->get();

        $featured_menus = Menu::active()->featured()->inRandomOrder()->limit(6)->get();
        
        return Inertia::render('Frontend/Home', [
            'title' => 'Home',
            'featured_categories' => CategoryResource::collection($featured_categories),
            'featured_menus' => MenuResource::collection($featured_menus),
        ]);
    }
}
