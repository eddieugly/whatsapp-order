<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the single category resource.
     */
    public function index(Category $category)
    {
        $category->load(['menus' => fn ($query) => $query->where('status', true)]);
        $all_categories = Category::select(['id', 'ulid', 'name', 'slug'])->whereHas('menus', function (Builder $query) {
            $query->where('status', true);
        })->active()->withCount(['menus' => fn (Builder $builder) => $builder->where('status', true)])->get();

        return Inertia::render('Frontend/Category', [
            'title' => $category?->name,
            'category'=> new CategoryResource($category),
            'all_categories' => CategoryResource::collection($all_categories),
        ]);
    }

    /**
     * Display a listing of the all category resource.
     */
    public function general()
    {
        $all_categories = Category::whereHas('menus', function (Builder $query) {
            $query->where('status', true);
        })->active()->get();
        
        return Inertia::render('Frontend/Categories', [
            'title' => 'Menu Categories',
            'all_categories' => CategoryResource::collection($all_categories),
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
    public function store(StoreCategoryRequest $request)
    {
        //
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
