<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\MenuResource;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class MenuController extends Controller
{
    private string $routeResourceName = 'menu';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus  = Menu::query()
            ->select([
                'id',
                'ulid',
                'category_id',
                'name',
                'description',
                'price',
                'status',
                'featured',
                'slider',
                'thumbnail',
            ])
            ->with(['category:id,name'])
            ->when(Request::input('name'), fn (Builder $builder, $name) => $builder->where('name', 'like', "%{$name}%"))
            ->when(Request::input('categoryId'), fn (Builder $builder, $categoryId) => $builder->whereHas(
                'category',
                fn (Builder $builder) => $builder->where('category.id', $categoryId)
            ))
            ->when(
                Request::input('active') !== null,
                fn (Builder $builder, $active) => $builder->when(
                    $active,
                    fn (Builder $builder) => $builder->active(),
                    fn (Builder $builder) => $builder->inActive()

                )
            )
            ->when(
                Request::input('featured') !== null,
                fn (Builder $builder, $featured) => $builder->where('featured', $featured)
            )
            ->when(
                Request::input('slider') !== null,
                fn (Builder $builder, $slider) => $builder->where('slider', $slider)
            )
            ->latest('id')
            ->paginate(10);

            return Inertia::render('Admin/Menu/Index', [
                'title' => 'Menu',
                'filters' => Request::only(['name', 'categoryId', 'active', 'featured', 'slider']),
                'items' => MenuResource::collection($menus),
                'headers' => [
                    [
                        'label' => 'Menu Name',
                        'name' => 'name'
                    ],
                    [
                        'label' => 'Price',
                        'name' => 'price'
                    ],
                    [
                        'label' => 'Category',
                        'name' => 'category'
                    ],
                    [
                        'label' => 'Status',
                        'name' => 'status'
                    ],
                    [
                        'label' => 'Featured',
                        'name' => 'features'
                    ],
                    [
                        'label' => 'Slider',
                        'name' => 'slider'
                    ],
                    [
                        'label' => 'Action',
                        'name' => 'action'
                    ]
                ],
                'routeResourceName' => $this->routeResourceName,
                'categories' => CategoryResource::collection(Category::get(['ulid', 'name'])),
                'can' => [
                    'create' => Request::user()->can('create menu'),
                    'edit' => Request::user()->can('edit menu'),
                    'delete' => Request::user()->can('delete menu'),
                ],
            ]);
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
    public function store(StoreMenuRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        //
    }
}
