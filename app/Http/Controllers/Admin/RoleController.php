<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreRoleRequest;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\UpdateRoleRequest;
use App\Http\Resources\PermissionResource;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    private string $routeResourceName = 'roles';
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::query()
        ->select([
            'id',
            'name',
            'created_at',
        ])->when(Request::input('search'), function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%');
        })->latest('id')
        ->paginate(10);

        return Inertia::render('Admin/Roles/Index', [
            'title' => 'Roles',
            'filters' => Request::only(['search']),
            'items' => RoleResource::collection($roles),
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
        return Inertia::render('Admin/Roles/Create', [
            'title' => 'Add Role',
            'routeResourceName' => $this->routeResourceName,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request): RedirectResponse
    {
        Role::create($request->validated());
        
        return Redirect::route('admin.roles.index')->with('success', 'Role Added Successfully');
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
    public function edit(Role $role)
    {
        
        $role->load(['permissions:permissions.id,permissions.name']);

        return Inertia::render('Admin/Roles/Edit', [
            'title' => 'Edit Role',
            'edit' => true,
            'item' => new RoleResource($role),
            'routeResourceName' => $this->routeResourceName,
            'permissions' => PermissionResource::collection(Permission::oldest('id')->get(['id', 'name'])),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role): RedirectResponse
    {
        $role->update($request->validated());

        return Redirect::route('admin.roles.index')->with('success', 'Role Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->back()->with('success', 'Role Deleted Successfully');
    }
}
