<?php

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create the user with avatar
        $user = User::create([
            'name' => 'Blog User',
            'email' => 'bloguser@example.com',
            'password' => Hash::make('password'),
            'avatar' => 'https://via.placeholder.com/150'
        ]);

        // Create 30 articles
        for ($a = 0; $a < 30; $a++) {
            $article = Article::create([
                'user_id' => $user->id,
                'title' => Str::random(10),
                'body' => Str::random(100),
            ]);

            // Attach random number of comments to each article
            for ($j = 0; $j < rand(1, 5); $j++) {
                $comment = new Comment([
                    'commenter_name' => Str::random(10),
                    'body' => Str::random(100),
                ]);
                $article->comments()->save($comment);
            }

            // Increment the upvotes counter for each article
            $upvotes = rand(1, 10);
            $article->update(['upvotes' => $upvotes]);
        }
    }
}
