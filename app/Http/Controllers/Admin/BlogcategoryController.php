<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Blogcategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Resources\BlogcategoryResource;
use App\Http\Requests\StoreBlogcategoryRequest;
use App\Http\Requests\UpdateBlogcategoryRequest;

class BlogcategoryController extends Controller
{
    private string $routeResourceName = 'blog-category';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogCategories = Blogcategory::query()
        ->select([
            'ulid',
            'name',
            'slug',
            'description',
            'thumbnail',
            'status',
            'featured',
        ])
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

        return Inertia::render('Admin/BlogCategory/Index', [
            'title' => 'Blog Category',
            'filters' => Request::only(['name']),
            'items' => BlogcategoryResource::collection($blogCategories),
            'headers' => [
                [
                    'label' => 'Blog Category',
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
        return Inertia::render('Admin/BlogCategory/Create', [
            'title' => 'Add Blog Category',
            'routeResourceName' => $this->routeResourceName,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogcategoryRequest $request)
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

        $blogcategory = Blogcategory::create($data);

        return Redirect::route('admin.blog-category.index')->with('success', 'Blog Category Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blogcategory $blogcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blogcategory $blog_category)
    {
        return Inertia::render('Admin/BlogCategory/Edit', [
            'title' => 'Edit Blog Category',
            'item' => new BlogcategoryResource($blog_category),
            'routeResourceName' => $this->routeResourceName,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogcategoryRequest $request, Blogcategory $blog_category)
    {
        $filename = $blog_category->thumbnail;
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
        
        $blog_category->update($data);

        return Redirect::route('admin.blog-category.index')->with('success', 'Blog Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blogcategory $blog_category)
    {
        $blog_category->delete();

        return Redirect::back()->with('success', 'Blog Category Deleted Successfully');
    }
}
