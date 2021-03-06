<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Video;
use App\Models\User;
use App\Models\Category;


class AddTags extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tags';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds category names as tags and changes filters from users.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Videos
        echo 'UPDATING VIDEOS', PHP_EOL, '===============', PHP_EOL;
        $count = 0;
        Video::withTrashed()->with('category')->chunk(200, function($videos) use ($count) {
            foreach($videos as $v) {
                echo 'Updating Video with ID: ', $v->id, PHP_EOL;
                $v->detag();
                // quick and dirty. not 100% correct though.
                if($v->category->shortname === 'pr0n')
                $v->tag('nsfw');
                else
                $v->tag('sfw');

                $v->tag(array_filter([$v->category->shortname
                    , $v->category->name
                    , $v->interpret
                    , $v->songtitle
                    , $v->imgsource
                ], function($elem) {
                    return !empty(trim($elem));
                }));
                $count++;
            }
        });
        echo PHP_EOL, PHP_EOL, 'Updated ', $count, ' Videos.', PHP_EOL, PHP_EOL, PHP_EOL;


        // User filters
        echo 'UPDATING USERS', PHP_EOL, '==============', PHP_EOL;
        $count = 0;
        $categories = Category::withTrashed()->get()->keyBy('id');

        User::withTrashed()->chunk(200, function($users) use (&$count, $categories) {
            foreach($users as $u) {
                echo 'Updating User: ', $u->username, PHP_EOL;
                $u->categories = array_values($categories->filter(function($cat) use($u) {
                    return !in_array($cat->id, $u->categories);
                })->map(function($cat) {
                    return $cat->shortname;
                })->all());
                $u->save();
                $count++;
            }
        });

        echo PHP_EOL, PHP_EOL, 'Updated ', $count, ' Users.', PHP_EOL, PHP_EOL, PHP_EOL;
    }
}

