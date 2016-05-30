<?php

use Illuminate\Database\Seeder;
use HepC\Models\PushNotificationType;

class PushTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('push_notification_types')->delete();
        PushNotificationType::create(array('name' => 'Like feed',    'title' => 'Like feed',    'slug'=>'like-feed',    'description' => 'Like an anonymous feed.'));
        PushNotificationType::create(array('name' => 'Comment feed', 'title' => 'Comment feed', 'slug'=>'comment-feed', 'description' => 'Make a comment on anonymous feed.'));
        PushNotificationType::create(array('name' => 'Like post',    'title' => 'Like post',    'slug'=>'like-post',    'description' => 'Like a post.'));
        PushNotificationType::create(array('name' => 'Comment post', 'title' => 'Comment post', 'slug'=>'comment-post', 'description' => 'Make a comment on post.'));

        $this->command->info('Push Type table seeded!');
    }
}
