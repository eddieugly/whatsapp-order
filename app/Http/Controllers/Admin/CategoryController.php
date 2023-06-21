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
use Illuminate\Support\Facades\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menuCategories = Category::query()
            ->when(Request::input('search'), function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->orderByDesc('created_at')
            ->paginate(10)
            ->through(fn ($menuCategory) => [
                'id' => $menuCategory->ulid,
                'name' => $menuCategory->name,
                'description' => $menuCategory->description,
                'thumbnail' => $menuCategory->thumbnail,
            ]);

            $filteredMenuCategories = $menuCategories->all();

        return Inertia::render('Admin/MenuCategory/Index', [
            'filters' => Request::only(['search']),
            'menuCategories' => $filteredMenuCategories,
            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/MenuCategory/Create');
    }

    public function testing()
    {
        return redirect()->back()->with('success', 'IT iS Working');
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
                
                return Redirect::back()->with('error', 'Could Not Upload Image');
            }
        }

        $data = $request->validated();

        

        Category::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'thumbnail' => $filename
        ]);

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
            'menuCategory' => [
                'id' => $category->ulid,
                'name' => $category->name,
                'description' => $category->description,
                'thumbnail' => $category->thumbnail
            ]
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
                
                return Redirect::back()->with('error', 'Could Not Upload Image');
            }
        }
        
        $data = $request->validated();
        
        $category->update([
            'name' => $data['name'],
            'description' => $data['description'],
            'thumbnail' => $filename
        ]);

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