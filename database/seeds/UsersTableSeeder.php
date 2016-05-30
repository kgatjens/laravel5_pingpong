<?php

use Illuminate\Database\Seeder;
use HepC\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'email' => 'admin@hepc.com',
            'password' => 'y72rarJyjpNTa0n5Dl',
        ]);
        $user->addRole(1);

        $user = User::create([
            'email' => 'editor@hepc.com',
            'password' => 'edOvFt4vk8roDG',
        ]);
        $user->addRole(2);
    }
}
