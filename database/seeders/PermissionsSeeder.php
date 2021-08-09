<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list allbos']);
        Permission::create(['name' => 'view allbos']);
        Permission::create(['name' => 'create allbos']);
        Permission::create(['name' => 'update allbos']);
        Permission::create(['name' => 'delete allbos']);

        Permission::create(['name' => 'list personneltypes']);
        Permission::create(['name' => 'view personneltypes']);
        Permission::create(['name' => 'create personneltypes']);
        Permission::create(['name' => 'update personneltypes']);
        Permission::create(['name' => 'delete personneltypes']);

        Permission::create(['name' => 'list offices']);
        Permission::create(['name' => 'view offices']);
        Permission::create(['name' => 'create offices']);
        Permission::create(['name' => 'update offices']);
        Permission::create(['name' => 'delete offices']);

        Permission::create(['name' => 'list statuses']);
        Permission::create(['name' => 'view statuses']);
        Permission::create(['name' => 'create statuses']);
        Permission::create(['name' => 'update statuses']);
        Permission::create(['name' => 'delete statuses']);

        Permission::create(['name' => 'list ranks']);
        Permission::create(['name' => 'view ranks']);
        Permission::create(['name' => 'create ranks']);
        Permission::create(['name' => 'update ranks']);
        Permission::create(['name' => 'delete ranks']);

        Permission::create(['name' => 'list compliances']);
        Permission::create(['name' => 'view compliances']);
        Permission::create(['name' => 'create compliances']);
        Permission::create(['name' => 'update compliances']);
        Permission::create(['name' => 'delete compliances']);

        Permission::create(['name' => 'list allpersonnel']);
        Permission::create(['name' => 'view allpersonnel']);
        Permission::create(['name' => 'create allpersonnel']);
        Permission::create(['name' => 'update allpersonnel']);
        Permission::create(['name' => 'delete allpersonnel']);

        Permission::create(['name' => 'list complianceactions']);
        Permission::create(['name' => 'view complianceactions']);
        Permission::create(['name' => 'create complianceactions']);
        Permission::create(['name' => 'update complianceactions']);
        Permission::create(['name' => 'delete complianceactions']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
