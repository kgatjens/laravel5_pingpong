<?php

use Illuminate\Database\Seeder;
use Pingpong\Trusty\Role;
use Pingpong\Trusty\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = array(
            'Manage Users',
            'Manage Settings',
            'Manage Roles',
            'Manage Permissions',
        );

        \DB::table('permissions')->delete();

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
                'slug' => $permission,
                'description' => $permission,
            ]);
        }

        $permissions = Permission::lists('id')->toArray();

        // Attach permissions to admin user
        Role::find(1)->permissions()->attach($permissions);
    }
}
