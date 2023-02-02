<?php

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Create the user with avatar
        $user = User::create([
            'name' => $faker->name,
            'email' => $faker->email,
            'password' => Hash::make('password'),
            'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80'
        ]);

        // Create 30 articles
        for ($a = 0; $a < 32; $a++) {
            $article = Article::create([
                'author_id' => $user->id,
                'title' => $faker->realText(50),
                'content' => $faker->realText(600),
            ]);

            $numberOfImages = rand(2, 4);
            for ($j = 0; $j < $numberOfImages; $j++) {
                $image = $this->UnsplashImage();
                $article->images()->create([
                    'url' => $image->urls->regular
                ]);
            }

            // Attach random number of comments to each article
            for ($c = 0; $c < rand(1, 5); $c++) {
                $comment = new Comment([
                    'author_name' => $faker->name,
                    'author_email' => $faker->email,
                    'text' => $faker->realText(250),
                ]);
                $article->comments()->save($comment);
            }

            // Increment the upvotes counter for each article
            $upvotes = rand(1, 5000);
            $article->update(['upvotes' => $upvotes]);
        }
    }

    private function UnsplashImage()
    {
        $client = new GuzzleHttp\Client();
        $response = $client->get('https://api.unsplash.com/photos/random?query=article&client_id=5x9zQmxR4NvkOjxxM3sb5FNDnQaYthxFocyZ5pbrNxY');
        $image = json_decode($response->getBody());
        return $image;
    }
}
