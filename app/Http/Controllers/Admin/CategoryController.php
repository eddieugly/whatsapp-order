<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Admin/MenuCategory/Index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/MenuCategory/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $filename = '';
        $path = imagePath()['categoryThumbnail']['path'];
        $size = imagePath()['categoryThumbnail']['size'];
        
        if ($request->hasFile('thumbnail')) {
            try {
                $filename = uploadImage($request->file('thumbnail'), $path, $size);
            } catch (\Exception $exp) {
                $notify[] = [
                    'type' => 'error',
                    'message' => 'Could Not Upload Image'
                ];
                return Redirect::back()->with('alerte', 'Category Added Successfully');
            }
        }

        $data = $request->validated();

        

        Category::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'thumbnail' => $filename
        ]);

        $notify[] = [
            'type' => 'success',
            'message' => 'Category Added Successfully'
        ];
        return to_route('admin.category.index')->with('alerte', 'Category Added Successfully');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
