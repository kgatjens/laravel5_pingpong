<?php

use Illuminate\Database\Seeder;
use HepC\Models\Challenges;

class ChallengesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('challenges')->delete();
        Challenges::create(array('title' => 'Challenge #1', 'description' => 'Drink at least 8 glasses of water a day!'));

        $this->command->info('Challenges table seeded!');
    }
}
