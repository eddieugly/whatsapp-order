<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Role::create(['name' => 'super admin']);

        $generalManager = Role::create(['name' => 'general manager']);

        $chefManager = Role::create(['name' => 'chef manager']);

        $staffManager = Role::create(['name' => 'staff manager']);

        $deliveryManager = Role::create(['name' => 'delivery manager']);

        $customerManager = Role::create(['name' => 'customer manager']);

        Permission::create(['name' => 'create staff']);
        Permission::create(['name' => 'edit staff']);
        Permission::create(['name' => 'delete staff']);
        Permission::create(['name' => 'view staff']);

        Permission::create(['name' => 'create category']);
        Permission::create(['name' => 'edit category']);
        Permission::create(['name' => 'delete category']);
        Permission::create(['name' => 'view category']);

        Permission::create(['name' => 'create menu']);
        Permission::create(['name' => 'edit menu']);
        Permission::create(['name' => 'delete menu']);
        Permission::create(['name' => 'view menu']);

        Permission::create(['name' => 'create gallery']);
        Permission::create(['name' => 'edit gallery']);
        Permission::create(['name' => 'delete gallery']);
        Permission::create(['name' => 'view gallery']);

        Permission::create(['name' => 'approve reservation']);
        Permission::create(['name' => 'decline reservation']);
        Permission::create(['name' => 'reschedule reservation']);
        Permission::create(['name' => 'view reservation']);

        Permission::create(['name' => 'create role']);
        $superPermit = Permission::create(['name' => 'edit role']);
        Permission::create(['name' => 'assign role']);
        Permission::create(['name' => 'revoke role']);
        Permission::create(['name' => 'delete role']);
        Permission::create(['name' => 'view role']);

        Permission::create(['name' => 'create permission']);
        Permission::create(['name' => 'edit permission']);
        Permission::create(['name' => 'assign permission']);
        Permission::create(['name' => 'revoke permission']);
        Permission::create(['name' => 'delete permission']);
        Permission::create(['name' => 'view permission']);

        Permission::create(['name' => 'create blog']);
        Permission::create(['name' => 'edit blog']);
        Permission::create(['name' => 'publish blog']);
        Permission::create(['name' => 'delete blog']);
        Permission::create(['name' => 'view blog']);

        Permission::create(['name' => 'view order']);
        Permission::create(['name' => 'manage order']);
        Permission::create(['name' => 'update order']);
        Permission::create(['name' => 'delete order']);

        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);

        $superPermit->assignRole($superAdmin);



        User::find(1)->assignRole($superAdmin);
        User::find(2)->assignRole($generalManager);
        User::find(3)->assignRole($chefManager);
        User::find(4)->assignRole($staffManager);
        User::find(5)->assignRole($deliveryManager);
        User::find(6)->assignRole($customerManager);
    }
}
