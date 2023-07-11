<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use Inertia\Inertia;
use App\Models\Blogcategory;
use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Http\Requests\StoreBlogRequest;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\UpdateBlogRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Resources\BlogcategoryResource;

class BlogController extends Controller
{
    private string $routeResourceName = 'blogs';

    public function __construct() {
        $this->middleware('can:view blog')->only('index');
        $this->middleware('can:create blog')->only(['create', 'store']);
        $this->middleware('can:edit blog')->only(['edit', 'update']);
        $this->middleware('can:delete blog')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs  = Blog::query()
            ->select([
                'id',
                'ulid',
                'blogcategory_id',
                'title',
                'description',
                'status',
                'featured',
                'slider',
                'thumbnail',
            ])
            ->with(['blogcategory:id,ulid,name,status,featured'])
            ->when(Request::input('title'), fn (Builder $builder, $title) => $builder->where('title', 'like', "%{$title}%"))
            ->when(Request::input('blogcategoryId'), fn (Builder $builder, $blogcategory) => $builder->whereHas(
                'blogcategory', fn (Builder $builder) => $builder->where('blogcategories.ulid', $blogcategory)
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

            return Inertia::render('Admin/Blog/Index', [
                'title' => 'Blog',
                'filters' => Request::only(['title', 'blogcategoryId', 'active', 'featured', 'slider']),
                'items' => BlogResource::collection($blogs),
                'headers' => [
                    [
                        'label' => 'Blog Title',
                        'name' => 'title'
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
                'blogcategories' => BlogcategoryResource::collection(Blogcategory::get(['ulid', 'name'])),
                'can' => [
                    'create' => Request::user()->can('create blog'),
                    'edit' => Request::user()->can('edit blog'),
                    'delete' => Request::user()->can('delete blog'),
                ],
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Blog/Create', [
            'title' => 'Add Blog',
            'routeResourceName' => $this->routeResourceName,
            'blogcategories' => BlogcategoryResource::collection(Blogcategory::get(['id', 'ulid', 'name'])),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
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

        $data = $request->safe()->only(['title', 'slug', 'description', 'status', 'featured', 'slider']);

        $blogcategoryId = Blogcategory::where('ulid', $request->blogcategory_id)->first();

        $data['blogcategory_id'] = $blogcategoryId->id;
        $data['thumbnail'] = $filename;

        Blog::create($data);

        return Redirect::route('admin.blogs.index')->with('success', 'Blog Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        $blog->load(['blogcategory', 'media']);
        return Inertia::render('Admin/Blog/Edit', [
            'title' => 'Edit Blog',
            'item' => new BlogResource($blog),
            'routeResourceName' => $this->routeResourceName,
            'blogcategories' => BlogcategoryResource::collection(Blogcategory::get(['ulid', 'name'])),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        $filename = $blog->thumbnail;
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
        $data = $request->safe()->only(['title', 'slug', 'description', 'status', 'featured', 'slider']);

        $blogcategoryId = Blogcategory::where('ulid', $request->blogcategory_id)->first();

        $data['blogcategory_id'] = $blogcategoryId->id;
        $data['thumbnail'] = $filename;

        $blog->update($data);

        return Redirect::route('admin.blogs.index')->with('success', 'Blog Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();

        return Redirect::back()->with('success', 'Blog Deleted Successfully');
    }
}
