<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use Inertia\Inertia;
use App\Models\Extra;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\MenuResource;
use App\Http\Resources\ExtraResource;
use App\Http\Requests\StoreMenuRequest;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\UpdateMenuRequest;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\Builder;

class MenuController extends Controller
{
    private string $routeResourceName = 'menu';

    public function __construct() {
        $this->middleware('can:view menu')->only('index');
        $this->middleware('can:create menu')->only(['create', 'store']);
        $this->middleware('can:edit menu')->only(['edit', 'update']);
        $this->middleware('can:delete menu')->only('destroy');
    }
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
            ->with(['category:id,ulid,name,status,featured'])
            ->when(Request::input('name'), fn (Builder $builder, $name) => $builder->where('name', 'like', "%{$name}%"))
            ->when(Request::input('categoryId'), fn (Builder $builder, $categoryId) => $builder->whereHas(
                'category', fn (Builder $builder) => $builder->where('categories.ulid', $categoryId)
            ))
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
        return Inertia::render('Admin/Menu/Create', [
            'title' => 'Add Menu',
            'routeResourceName' => $this->routeResourceName,
            'categories' => CategoryResource::collection(Category::get(['id', 'ulid', 'name'])),
            'extras' => ExtraResource::collection(Extra::get(['ulid', 'name'])),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMenuRequest $request)
    {
        $filename = '';
        $path = imagePath()['menuThumbnail']['path'];
        $size = imagePath()['menuThumbnail']['size'];
        
        if ($request->hasFile('thumbnail')) {
            try {
                $filename = uploadImage($request->thumbnail, $path, $size);
            } catch (\Exception $exp) {
                $errorMessage = $exp->getMessage();                
                return Redirect::back()->with('error', $errorMessage);
            }
        }

        $data = $request->safe()->only(['name', 'slug', 'description', 'price', 'status', 'featured', 'slider', 'has_extras']);

        $categoryId = Category::where('ulid', $request->category_id)->first();

        if ($request->extras) {
            $extras = Extra::whereIn('ulid', $request->extras)->get();
        }
        

        $data['category_id'] = $categoryId->id;
        $data['thumbnail'] = $filename;

        $menu = Menu::create($data);

        $menu->extras()->sync($extras);

        return Redirect::route('admin.menu.index')->with('success', 'Menu Added Successfully');
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
        $menu->load(['category', 'media', 'extras']);
        
        return Inertia::render('Admin/Menu/Edit', [
            'title' => 'Edit Menu',
            'item' => new MenuResource($menu),
            'routeResourceName' => $this->routeResourceName,
            'categories' => CategoryResource::collection(Category::get(['ulid', 'name'])),
            'extras' => ExtraResource::collection(Extra::get(['ulid', 'name'])),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        
        

        $filename = $menu->thumbnail;
        $path = imagePath()['menuThumbnail']['path'];
        $size = imagePath()['menuThumbnail']['size'];
        
        if ($request->hasFile('thumbnail')) {
            try {
                $filename = uploadImage($request->thumbnail, $path, $size);
            } catch (\Exception $exp) {
                $errorMessage = $exp->getMessage();                
                return Redirect::back()->with('error', $errorMessage);
            }
        }
        $data = $request->safe()->only(['name', 'slug', 'description', 'price', 'status', 'featured', 'slider', 'has_extras']);

        $categoryId = Category::where('ulid', $request->category_id)->first();
        $extras = Extra::whereIn('ulid', $request->extras)->get();

        $menu->extras()->sync($extras);
        

        $data['category_id'] = $categoryId->id;
        $data['thumbnail'] = $filename;

        $menu->update($data);

        return Redirect::route('admin.menu.index')->with('success', 'Menu Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();

        return Redirect::back()->with('success', 'Menu Deleted Successfully');
    }
}
