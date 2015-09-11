<?php

use Illuminate\Database\Seeder;

class VideoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $videos = glob(public_path() . '/b/*');
        $category = \App\Models\Category::where('name', '=', 'Misc')->first();
        $user = \App\Models\User::first();

        foreach($videos as $video) {
            $v = new \App\Models\Video();
            $v->user()->associate($user);
            $v->category()->associate($category);
            $v->hash = sha1_file($video);
            $v->file = basename($video);
            $v->save();
        }
    }
}