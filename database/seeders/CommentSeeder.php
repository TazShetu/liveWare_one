<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comments = [
            0 => [1, 'Title 1',
                'Comment 1 Body. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium architecto, corporis eius expedita minima molestiae nihil odit quod repellendus rerum.',
                'John Doe Seed'
                ],
            1 => [1, 'Title 2',
                'Comment 2 Body. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium architecto, corporis eius expedita minima molestiae nihil odit quod repellendus rerum.',
                'John Doe Seed'
                ],
            2 => [2, 'Title 3',
                'Comment 3 Body. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium architecto, corporis eius expedita minima molestiae nihil odit quod repellendus rerum.',
                'Joep Seed'
                ],
            3 => [1, 'Title 4',
                'Comment 4 Body. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium architecto, corporis eius expedita minima molestiae nihil odit quod repellendus rerum.',
                'Joep Seed'
                ],

        ];
        foreach ($comments as $comment) {
            $c = new Comment;
            $c->post_id = $comment[0];
            $c->title = $comment[1];
            $c->body = $comment[2];
            $c->creator = $comment[3];
            $c->save();
        }
    }
}
