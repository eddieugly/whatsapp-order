<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Request;

class CategoryController extends Controller
{
    private string $routeResourceName = 'category';
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menuCategories = Category::query()
        ->select([
            'ulid',
            'name',
            'slug',
            'description',
            'thumbnail',
            'status',
            'featured',
        ])
        ->withCount(['menus' => fn (Builder $builder) => $builder->where('status', true)])
        ->when(Request::input('name'), fn (Builder $builder, $name) => $builder->where('name', 'like', "%{$name}%"))
        ->when(
            Request::input('status') !== null, fn (Builder $builder) => $builder->when(
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
        ->latest('id')
        ->paginate(10)
        ->withQueryString();

        return Inertia::render('Admin/MenuCategory/Index', [
            'title' => 'Category',
            'filters' => Request::only(['name', 'status', 'featured']),
            'items' => CategoryResource::collection($menuCategories),
            'headers' => [
                [
                    'label' => 'Category Name',
                    'name' => 'name'
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
                    'label' => 'Action',
                    'name' => 'action'
                ]
            ],
            'routeResourceName' => $this->routeResourceName,
            'can' => [
                'create' => Request::user()->can('create category'),
                'edit' => Request::user()->can('edit category'),
                'delete' => Request::user()->can('delete category'),
            ],
            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/MenuCategory/Create', [
            'title' => 'Add Category',
            'routeResourceName' => $this->routeResourceName,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $filename = '';
        $path = imagePath()['categoryThumbnail']['path'];
        $size = imagePath()['categoryThumbnail']['size'];
        
        if ($request->hasFile('thumbnail')) {
            try {
                $filename = uploadImage($request->thumbnail, $path, $size);
            } catch (\Exception $exp) {
                $errorMessage = $exp->getMessage();                
                return Redirect::back()->with('error', $errorMessage);
            }
        }

        $data = $request->safe()->only(['name', 'slug', 'description', 'status', 'featured']);

        $data['thumbnail'] = $filename;

        $category = Category::create($data);

        return Redirect::route('admin.category.index')->with('success', 'Category Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return Inertia::render('Admin/MenuCategory/Edit', [
            'title' => 'Edit Category',
            'item' => new CategoryResource($category),
            'routeResourceName' => $this->routeResourceName,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        
        $filename = $category->thumbnail;
        $path = imagePath()['categoryThumbnail']['path'];
        $size = imagePath()['categoryThumbnail']['size'];
        
        if ($request->hasFile('thumbnail')) {
            try {
                $filename = uploadImage($request->thumbnail, $path, $size);
            } catch (\Exception $exp) {
                $errorMessage = $exp->getMessage();                
                return Redirect::back()->with('error', $errorMessage);
            }
        }
        
        $data = $request->safe()->only(['name', 'slug', 'description', 'status', 'featured']);

        $data['thumbnail'] = $filename;
        
        $category->update($data);

        return redirect('/admin/category')->with('success', 'Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return Redirect::back()->with('success', 'Category Deleted Successfully');
    }
}
