<?php

use Illuminate\Database\Seeder;
use HepC\Models\Comments;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->delete();
        Comments::create(array('name' => 'Awesome!', 'order' => 1));

        $this->command->info('Comments table seeded!');
    }
}
