<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Menu;
use Inertia\Inertia;
use App\Models\Category;
use App\Http\Resources\MenuResource;
use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\Builder;

class MenuController extends Controller
{
    /**
     * Display a listing of the single category resource.
     */
    public function index(Menu $menu)
    {
        $menu->load(['category:id,ulid,name', 'media']);

        return Inertia::render('Frontend/Menu', [
            'title' => $menu?->name,
            'menu'=> new MenuResource($menu),
        ]);
    }


    /**
     * Display a listing of the all Active Menu resource with multi category search query.
     */
    public function general()
    {
        $all_menus = Menu::select([
            'id',
            'ulid',
            'name',
            'slug',
            'description',
            'price',
            'thumbnail',
        ])
        ->active()
        ->whereHas('category', fn (Builder $builder) => $builder->where('status', true))
        ->when(Request::input('category'), function (Builder $builder, $categories) {
            $builder->whereHas('category', function (Builder $builder) use ($categories) {
                $builder->whereIn('categories.slug', $categories);
            });
        })->get();

        $all_categories = Category::select(['id', 'ulid', 'name', 'slug'])->whereHas('menus', function (Builder $query) {
            $query->where('status', true);
        })->active()->withCount(['menus' => function (Builder $builder) {$builder->where('status', true);}])->get();

        return Inertia::render('Frontend/Menus', [
            'title' => 'Our Menu',
            'all_menus' => MenuResource::collection($all_menus),
            'filters' => Request::only(['category']),
            'all_categories' => CategoryResource::collection($all_categories),
        ]);
    }
}
