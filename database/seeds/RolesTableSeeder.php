<?php

use Illuminate\Database\Seeder;
use Pingpong\Trusty\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('roles')->delete();

        Role::create([
            'name' => 'Administrator',
            'slug' => 'admin',
        ]);

        Role::create([
            'name' => 'Editor',
            'slug' => 'editor',
        ]);
    }
}
