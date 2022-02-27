<?php

namespace App\Modules\posts_metrics\src\Commands;

use App\Modules\posts_metrics\src\Models\PostsMetric;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;

class GeneratePostsMetrics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'metrics:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates metrics for posts';

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
     * @return int
     */
    public function handle()
    {
        $groups = array('vk', 'ok', 'fb');

        for ($i = 0; $i < 1000; $i++) {
            $post = PostsMetric::create([
                'post_id' => $i,
                'group_type' => Arr::random($groups),
                'views' => rand(1,10000),
                'likes' => rand(0,10000),
                'comments' => rand(0, 100),
                'reposts' => rand(0, 1000)
            ]);
        }

        return 0;
    }
}
