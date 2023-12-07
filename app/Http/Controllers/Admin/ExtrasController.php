<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Extra;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExtraResource;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\Builder;

class ExtrasController extends Controller
{

    private string $routeResourceName = 'extras';

    public function __construct() {
        $this->middleware('can:view menu')->only('index');
        $this->middleware('can:create menu')->only(['create', 'store']);
        $this->middleware('can:edit menu')->only(['edit', 'update']);
        $this->middleware('can:delete menu')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $extras = Extra::query()
        ->select(['id', 'ulid', 'name', 'is_required'])
        ->when($request->input('name'), fn (Builder $builder, $name) => $builder->where('name', 'like', "%{$name}%"))
        ->latest('id')
        ->paginate(10)
        ->withQueryString();

        return Inertia::render('Admin/Extras/Index', [
            'title' => 'Extras',
            'filters' => $request->only(['name']),
            'items' => ExtraResource::collection($extras),
            'headers' => [
                [
                    'label' => 'Name',
                    'name' => 'name'
                ],
                [
                    'label' => 'Required',
                    'name' => 'required',
                ],
                [
                    'label' => 'Action',
                    'name' => 'action'
                ]
            ],
            'routeResourceName' => $this->routeResourceName,
            'can' => [
                'create' => $request->user()->can('create menu'),
                'edit' => $request->user()->can('edit menu'),
                'delete' => $request->user()->can('delete menu'),
            ],
            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Extras/Create', [
            'title' => 'Add Extras',
            'routeResourceName' => $this->routeResourceName,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['bail', 'required', 'string', 'max:30', Rule::unique(Extra::class, 'name')],
            'is_required' => ['bail', 'sometimes', 'boolean'],
        ]);

        Extra::create($validated);

        return Redirect::route('admin.extras.index')->with('success', 'Extras Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Extra $extra)
    {
        return Inertia::render('Admin/Extras/Edit', [
            'title' => 'Edit Extras',
            'item' => new ExtraResource($extra),
            'routeResourceName' => $this->routeResourceName,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Extra $extra)
    {
        
        $validated = $request->validate([
            'name' => ['bail', 'required', 'string', 'max:30', Rule::unique(Extra::class, 'name')->ignore($extra)],
            'is_required' => ['bail', 'sometimes', 'boolean'],
        ]);

        $extra->update($validated);

        return Redirect::route('admin.extras.index')->with('success', 'Extras Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Extra $extra)
    {
        $extra->delete();

        return Redirect::back()->with('success', 'Extras Deleted Successfully');
    }
}
