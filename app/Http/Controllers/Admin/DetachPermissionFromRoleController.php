<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DetachPermissionFromRoleController extends Controller
{
    public function __construct() {
        $this->middleware('can:edit role');
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $permission = Permission::findById($request->permissionId);

        $role = Role::findById($request->roleId);

        $permission->removeRole($role);

        return redirect()->back()->with('success', 'Permission Detached Successfully');
    }
}
