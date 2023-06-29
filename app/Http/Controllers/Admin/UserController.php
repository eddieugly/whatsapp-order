<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use App\Http\Resources\UserResource;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{

    private string $routeResourceName = 'users';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::query()
        ->select([
            'id',
            'ulid',
            'name',
            'email',
            'created_at',
        ])
        ->with(['roles:roles.id,roles.name'])
        ->when(Request::input('search'), function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%');
            })->latest('id')
            ->paginate(10);

        return Inertia::render('Admin/Users/Index', [
            'title' => 'Users',
            'filters' => Request::only(['search']),
            'items' => UserResource::collection($users),
            'headers' => [
                [
                    'label' => 'User Name',
                    'name' => 'name'
                ],
                [
                    'label' => 'User Email',
                    'name' => 'headers'
                ],
                [
                    'label' => 'Role',
                    'name' => 'role'
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
        return Inertia::render('Admin/Users/Create', [
            'title' => 'Add User',
            'routeResourceName' => $this->routeResourceName,
            'roles' => RoleResource::collection(Role::get(['id', 'name'])),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->safe()->only(['name', 'email', 'password']));

        $role = Role::findById($request->roleId);

        $user->assignRole($role);

        return Redirect::route('admin.users.index')->with('success', 'User Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $user->load(['roles:roles.id']);

        return Inertia::render('Admin/MenuCategory/Edit', [
            'title' => 'Edit User',
            'item' => new UserResource($user),
            'routeResourceName' => $this->routeResourceName,
            'roles' => RoleResource::collection(Role::get(['id', 'name'])),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->safe()->only(['name', 'email', 'password']));

        $role = Role::findById($request->roleId);

        $user->syncRoles($role);

        return Redirect::route('admin.users.index')->with('success', 'User Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return Redirect::back()->with('success', 'User Deleted Successfully');
    }
}
