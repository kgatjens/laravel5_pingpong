<?php

use Illuminate\Database\Seeder;
use HepC\Models\CategoriesTips;

class CategoriesTipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories_tips')->delete();
        CategoriesTips::create(array('title' => 'Healthy Recipes', 'description' => '', 'icon_path' => '/images/tips/category/default/icon1.png'));
        CategoriesTips::create(array('title' => 'Liver Friendly Foods', 'description' => '', 'icon_path' => '/images/tips/category/default/icon2.png'));
        CategoriesTips::create(array('title' => 'Shopping List', 'description' => '', 'icon_path' => '/images/tips/category/default/icon3.png'));
        CategoriesTips::create(array('title' => 'Getting Started With Excercise', 'description' => '', 'icon_path' => '/images/tips/category/default/icon4.png'));
        CategoriesTips::create(array('title' => 'Easy Exercises', 'description' => '', 'icon_path' => '/images/tips/category/default/icon5.png'));
        CategoriesTips::create(array('title' => 'Benefits of Exercises', 'description' => '', 'icon_path' => '/images/tips/category/default/icon6.png'));
        CategoriesTips::create(array('title' => 'What to Expect Week by Week', 'description' => '', 'icon_path' => '/images/tips/category/default/icon7.png'));
        CategoriesTips::create(array('title' => 'Staying Safe', 'description' => '', 'icon_path' => '/images/tips/category/default/icon8.png'));
        CategoriesTips::create(array('title' => 'Dealing with Life Events', 'description' => '', 'icon_path' => '/images/tips/category/default/icon9.png'));
        CategoriesTips::create(array('title' => 'Managing Stress', 'description' => '', 'icon_path' => '/images/tips/category/default/icon10.png'));
        CategoriesTips::create(array('title' => 'Treatment Tips', 'description' => '', 'icon_path' => '/images/tips/category/default/icon11.png'));
        CategoriesTips::create(array('title' => 'keeping Your Liver Healthy', 'description' => '', 'icon_path' => '/images/tips/category/default/icon12.png'));

        $this->command->info('CategoriesTips table seeded!');
    }
}
