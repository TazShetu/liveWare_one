<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = [
            0 => ['Post Title 1',
                'Post 1 Body. Lorem corporis eius expedita minima molestiae nihil odit quod repellendus rerum.',
            ],
            1 => ['Post Title 2',
                'Post 2 Body. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium architecto.',
            ],
        ];
        foreach ($posts as $post) {
            $p = new Post;
            $p->title = $post[0];
            $p->body = $post[1];
            $p->save();
        }
    }
}
