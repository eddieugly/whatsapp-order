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

        $customerManager = Role::create(['name' => 'our customer']);

        $superPermit1 = Permission::create(['name' => 'create staff']);
        $superPermit2 = Permission::create(['name' => 'edit staff']);
        $superPermit3 = Permission::create(['name' => 'delete staff']);
        $superPermit4 = Permission::create(['name' => 'view staff']);

        $superPermit5 = Permission::create(['name' => 'create category']);
        $superPermit6 = Permission::create(['name' => 'edit category']);
        $superPermit7 = Permission::create(['name' => 'delete category']);
        $superPermit8 = Permission::create(['name' => 'view category']);

        $superPermit9 = Permission::create(['name' => 'create menu']);
        $superPermit10 = Permission::create(['name' => 'edit menu']);
        $superPermit11 = Permission::create(['name' => 'delete menu']);
        $superPermit12 = Permission::create(['name' => 'view menu']);

        $superPermit13 = Permission::create(['name' => 'create gallery']);
        $superPermit14 = Permission::create(['name' => 'edit gallery']);
        $superPermit15 = Permission::create(['name' => 'delete gallery']);
        $superPermit16 = Permission::create(['name' => 'view gallery']);

        $superPermit17 = Permission::create(['name' => 'approve reservation']);
        $superPermit18 = Permission::create(['name' => 'decline reservation']);
        $superPermit19 = Permission::create(['name' => 'reschedule reservation']);
        $superPermit20 = Permission::create(['name' => 'view reservation']);

        $superPermit21 = Permission::create(['name' => 'create role']);
        $superPermit22 = Permission::create(['name' => 'edit role']);
        $superPermit23 = Permission::create(['name' => 'assign role']);
        $superPermit24 = Permission::create(['name' => 'revoke role']);
        $superPermit25 = Permission::create(['name' => 'delete role']);
        $superPermit26 = Permission::create(['name' => 'view role']);

        $superPermit27 = Permission::create(['name' => 'create permission']);
        $superPermit28 = Permission::create(['name' => 'edit permission']);
        $superPermit29 = Permission::create(['name' => 'assign permission']);
        $superPermit30 = Permission::create(['name' => 'revoke permission']);
        $superPermit31 = Permission::create(['name' => 'delete permission']);
        $superPermit32 = Permission::create(['name' => 'view permission']);

        $superPermit33 = Permission::create(['name' => 'create blog']);
        $superPermit34 = Permission::create(['name' => 'edit blog']);
        $superPermit35 = Permission::create(['name' => 'publish blog']);
        $superPermit36 = Permission::create(['name' => 'delete blog']);
        $superPermit37 = Permission::create(['name' => 'view blog']);

        $superPermit38 = Permission::create(['name' => 'view order']);
        $superPermit39 = Permission::create(['name' => 'manage order']);
        $superPermit40 = Permission::create(['name' => 'update order']);
        $superPermit41 = Permission::create(['name' => 'delete order']);

        $superPermit42 = Permission::create(['name' => 'view users']);
        $superPermit43 = Permission::create(['name' => 'create users']);
        $superPermit44 = Permission::create(['name' => 'edit users']);
        $superPermit45 = Permission::create(['name' => 'delete users']);

        $superPermit1->assignRole([$superAdmin, $generalManager]);
        $superPermit2->assignRole([$superAdmin, $generalManager]);
        $superPermit3->assignRole([$superAdmin, $generalManager]);
        $superPermit4->assignRole([$superAdmin, $generalManager]);
        $superPermit5->assignRole([$superAdmin, $generalManager]);
        $superPermit6->assignRole([$superAdmin, $generalManager]);
        $superPermit7->assignRole([$superAdmin, $generalManager]);
        $superPermit8->assignRole([$superAdmin, $generalManager]);
        $superPermit9->assignRole([$superAdmin, $generalManager]);
        $superPermit10->assignRole([$superAdmin, $generalManager]);
        $superPermit11->assignRole([$superAdmin, $generalManager]);
        $superPermit12->assignRole([$superAdmin, $generalManager]);
        $superPermit13->assignRole([$superAdmin, $generalManager]);
        $superPermit14->assignRole([$superAdmin, $generalManager]);
        $superPermit15->assignRole([$superAdmin, $generalManager]);
        $superPermit16->assignRole([$superAdmin, $generalManager]);
        $superPermit17->assignRole([$superAdmin, $generalManager]);
        $superPermit18->assignRole([$superAdmin, $generalManager]);
        $superPermit19->assignRole([$superAdmin, $generalManager]);
        $superPermit20->assignRole([$superAdmin, $generalManager]);
        $superPermit21->assignRole([$superAdmin, $generalManager]);
        $superPermit22->assignRole([$superAdmin, $generalManager]);
        $superPermit23->assignRole([$superAdmin, $generalManager]);
        $superPermit24->assignRole([$superAdmin, $generalManager]);
        $superPermit25->assignRole([$superAdmin, $generalManager]);
        $superPermit26->assignRole([$superAdmin, $generalManager]);
        $superPermit27->assignRole([$superAdmin, $generalManager]);
        $superPermit28->assignRole([$superAdmin, $generalManager]);
        $superPermit29->assignRole([$superAdmin, $generalManager]);
        $superPermit30->assignRole([$superAdmin, $generalManager]);
        $superPermit31->assignRole([$superAdmin, $generalManager]);
        $superPermit32->assignRole([$superAdmin, $generalManager]);
        $superPermit33->assignRole([$superAdmin, $generalManager]);
        $superPermit34->assignRole([$superAdmin, $generalManager]);
        $superPermit35->assignRole([$superAdmin, $generalManager]);
        $superPermit36->assignRole([$superAdmin, $generalManager]);
        $superPermit37->assignRole([$superAdmin, $generalManager]);
        $superPermit38->assignRole([$superAdmin, $generalManager]);
        $superPermit39->assignRole([$superAdmin, $generalManager]);
        $superPermit40->assignRole([$superAdmin, $generalManager]);
        $superPermit41->assignRole([$superAdmin, $generalManager]);
        $superPermit42->assignRole([$superAdmin, $generalManager]);
        $superPermit43->assignRole([$superAdmin, $generalManager]);
        $superPermit44->assignRole([$superAdmin, $generalManager]);
        $superPermit45->assignRole([$superAdmin, $generalManager]);



        User::find(1)->assignRole($superAdmin);
        User::find(2)->assignRole($generalManager);
        User::find(3)->assignRole($chefManager);
        User::find(4)->assignRole($staffManager);
        User::find(5)->assignRole($deliveryManager);
        User::find(6)->assignRole($customerManager);
    }
}
