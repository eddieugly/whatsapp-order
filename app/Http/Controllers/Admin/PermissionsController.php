<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;
use App\Http\Resources\PermissionResource;
use App\Http\Requests\StorePermissionsRequest;
use App\Http\Requests\UpdatePermissionsRequest;


class PermissionsController extends Controller
{
    private string $routeResourceName = 'permissions';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::query()
        ->select([
            'id',
            'name',
            'created_at',
        ])->when(Request::input('search'), function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%');
        })->latest('id')
        ->paginate(10);

        return Inertia::render('Admin/Permissions/Index', [
            'title' => 'Permissionss',
            'filters' => Request::only(['search']),
            'items' => PermissionResource::collection($permissions),
            'headers' => [
                [
                    'label' => 'Name',
                    'name' => 'name'
                ],
                [
                    'label' => 'Created At',
                    'name' => 'created_at'
                ],
                [
                    'label' => 'Action',
                    'name' => 'action'
                ]
            ],
            'routeResourceName' => $this->routeResourceName,
            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Permissions/Create', [
            'title' => 'Add Permission',
            'routeResourceName' => $this->routeResourceName,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePermissionsRequest $request): RedirectResponse
    {
        Permission::create($request->validated());
        
        return Redirect::route('admin.permissions.index')->with('success', 'Permissions Added Successfully');
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
    public function edit(Permission $permissions)
    {
        return Inertia::render('Admin/Permissions/Edit', [
            'title' => 'Edit Permission',
            'edit' => true,
            'item' => new PermissionResource($permissions),
            'routeResourceName' => $this->routeResourceName,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePermissionsRequest $request, Permission $permissions): RedirectResponse
    {
        $permissions->update($request->validated());

        return Redirect::route('admin.permissions.index')->with('success', 'Permissions Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permissions)
    {
        $permissions->delete();

        return redirect()->back()->with('success', 'Permissions Deleted Successfully');
    }
}
