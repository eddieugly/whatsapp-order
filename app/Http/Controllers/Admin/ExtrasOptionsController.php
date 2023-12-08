<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Extra;
use App\Models\ExtraOption;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExtraResource;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Resources\ExtraOptionResource;

class ExtrasOptionsController extends Controller
{

    private string $routeResourceName = 'extra-options';

    public function __construct()
    {
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
        $extra_options = ExtraOption::query()
            ->select(['id', 'ulid', 'extra_id', 'name', 'price'])
            ->when($request->input('name'), fn (Builder $builder, $name) => $builder->where('name', 'like', "%{$name}%"))
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Admin/ExtraOptions/Index', [
            'title' => 'Extra Options',
            'filters' => $request->only(['name']),
            'items' => ExtraOptionResource::collection($extra_options),
            'headers' => [
                [
                    'label' => 'Name',
                    'name' => 'name'
                ],
                [
                    'label' => 'Price',
                    'name' => 'price',
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
        return Inertia::render('Admin/ExtraOptions/Create', [
            'title' => 'Add Extra Options',
            'routeResourceName' => $this->routeResourceName,
            'extras' => ExtraResource::collection(Extra::get(['id', 'ulid', 'name'])),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'extra_id' => ['bail', 'required', Rule::exists(Extra::class, 'ulid')],
            'name' => ['bail', 'required', 'string', 'max:30'],
            'price' => ['bail', 'required', 'integer'],
        ]);

        $extraId = Extra::where('ulid', $request->extra_id)->first();


        ExtraOption::create([
            'extra_id' => $extraId->id,
            'name' => $validated['name'],
            'price' => $validated['price'],
        ]);

        return Redirect::route('admin.extra-options.index')->with('success', 'Extra Options Added Successfully');
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
    public function edit(ExtraOption $extra_option)
    {
        $extra_option->load('extras');

        return Inertia::render('Admin/ExtraOptions/Edit', [
            'title' => 'Edit Extra Options',
            'item' => new ExtraOptionResource($extra_option),
            'routeResourceName' => $this->routeResourceName,
            'extras' => ExtraResource::collection(Extra::get(['ulid', 'name'])),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ExtraOption $extra_option)
    {
        $validated = $request->validate([
            'extra_id' => ['bail', 'required', Rule::exists(Extra::class, 'ulid')],
            'name' => ['bail', 'required', 'string', 'max:30', Rule::unique('extra_options')
            ->where(function ($query) use ($request, $extra_option) {
                return $query->where('extra_id', Extra::where('ulid', $request->extra_id)->first()->id)
                    ->where('name', '!=', $extra_option->name);
            })],
            'price' => ['bail', 'required', 'integer'],
        ]);

        $extraId = Extra::where('ulid', $request->extra_id)->first();


        $extra_option->update([
            'extra_id' => $extraId->id,
            'name' => $validated['name'],
            'price' => $validated['price'],
        ]);

        return Redirect::route('admin.extra-options.index')->with('success', 'Extras Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExtraOption $extra_option)
    {
        $extra_option->delete();

        return Redirect::back()->with('success', 'Extras Deleted Successfully');
    }
}
