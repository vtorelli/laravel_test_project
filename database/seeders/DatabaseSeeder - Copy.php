<?php

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use App\Models\Image;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Clear all tables in the database
        DB::table('comments')->truncate();
        DB::table('images')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('articles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('users')->truncate();

        // start populating DB

        $faker = Faker::create();

        echo "creating blog owner";
        // Create the user with avatar
        $user = User::create([
            'name' => "Marion",
            'email' => "marion@marion.com",
            'password' => "marion",
            'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80'
        ]);

        echo "\n";
        echo "User $user->name created";
        echo "\n---------------------------------------------------------\n";
        echo "\n";
        echo "Creating blog articles, please hold on......";
        echo "\n";

        // Create 32 articles
        for ($a = 0; $a < 32; $a++) {
            $article = Article::create([
                'author_id' => $user->id,
                'title' => $faker->realText(50),
                'content' => $faker->realText(10000),
            ]);

            echo "creating article $article->title, please wait.....";
            echo "\n";
            echo "adding images....";
            echo "\n";

            $images = $this->loadImages();
            foreach ($images as $image) {
                $article->images()->create([
                    'url' => $image
                ]);
            }

            echo "images added succesfully";
            echo "adding comments....";
            echo "\n";

            // Attach random number of comments to each article
            for ($c = 0; $c < rand(1, 5); $c++) {
                $comment = new Comment([
                    'author_name' => $faker->name,
                    'author_email' => $faker->email,
                    'content' => $faker->realText(250),
                ]);
                $article->comments()->save($comment);
            }

            echo "comments added succesfully";
            echo "\n";
            echo "upvoting article....";
            echo "\n";

            // Increment the upvotes counter for each article
            $upvotes = rand(1, 1000);
            $article->update(['upvotes' => $upvotes]);

            echo "$upvotes upvotes, yay!\n";
            echo "\n---------------------------------------------------------\n";
        }
    }

    private function loadImages()
    {
        return [
            'actionvance-n-2_KHgeAy0-unsplash.jpg',
            'aleksandra-kalinichenko-4r4FSP37lrI-unsplash',
            'alex-chambers-CyMd0vOYFfU-unsplash',
            'alexandra-gorn-W5dsm9n6e3g-unsplash',
            'alex-ware-46wcybPvfMA-unsplash',
            'andrew-charney-PZZ31takeSU-unsplash',
            'anete-lusina-zwsHjakE_iI-unsplash',
            'annie-spratt-8mqOw4DBBSg-unsplash',
            'annie-spratt-d3d_aHFPVPM-unsplash',
            'annie-spratt-witXfU5_it0-unsplash',
            'arnel-hasanovic-MNd-Rka1o0Q-unsplash',
            'artur-rutkowski-GdTLaWamFHw-unsplash',
            'austin-chan-ukzHlkoz1IE-unsplash',
            'ayrus-hill-2fsDwu5Zza4-unsplash',
            'ben-neale-zpxKdH_xNSI-unsplash',
            'big-dodzy-sJ3ZEd0SIX8-unsplash',
            'brooke-lark-nTZOILVZuOg-unsplash',
            'bruno-guerrero-x-N7r7ptxcE-unsplash',
            'carl-raw-FhtnBTSkrp0-unsplash',
            'ceyda-ciftci-dDVU6D_6T80-unsplash',
            'chris-lee-70l1tDAI6rM-unsplash',
            'christian-lambert-XR0kq2VDIUo-unsplash',
            'christian-thoni-EiEZS7H-xP0-unsplash',
            'clark-tibbs-oqStl2L5oxI-unsplash',
            'craig-sybert-S-vkpXA3os8-unsplash',
            'dakota-corbin-PmNjS6b3XP4-unsplash',
            'daniel-k-cheung-bO4UR1VzQu8-unsplash',
            'daniel-k-cheung-cPF2nlWcMY4-unsplash',
            'diego-ph-fIq0tET6llw-unsplash',
            'edgar-castrejon-1CsaVdwfIew-unsplash',
            'edu-lauton-TyQ-0lPp6e4-unsplash',
            'element5-digital-uE2T1tCFsn8-unsplash',
            'erica-marsland-huynh-yNyTgP0QzQQ-unsplash',
            'erik-mclean-v-j8QFdMJmg-unsplash',
            'ferhat-deniz-fors-ugOgx_MJ_T0-unsplash',
            'geeky-shots-hQ4BQ3wdHsQ-unsplash',
            'glenn-carstens-peters-npxXWgQ33ZQ-unsplash',
            'haley-lawrence-eWYGa88K0Yg-unsplash',
            'hamza-nouasria-x_XDSQODS54-unsplash',
            'hello-i-m-nik-5f2BYO8CuGA-unsplash',
            'hello-i-m-nik-73_kRzs9sqo-unsplash',
            'hello-i-m-nik-lWIM6FXIfnI-unsplash',
            'ian-schneider-TamMbr4okv4-unsplash',
            'ivan-rudoy-cJjkxNyCnPE-unsplash',
            'ivan-rudoy-H1CzGhDhSAY-unsplash',
            'jason-briscoe-heEPoapeiVk-unsplash',
            'jason-leung-AxKqisRPQSA-unsplash',
            'jason-leung-Qg_gUciqwmU-unsplash',
            'jean-philippe-delberghe-QIr4waPAuy4-unsplash',
            'jefferson-sees-TuZW31_XMDM-unsplash',
            'john-towner-UO02gAW3c0c-unsplash',
            'jonas-jacobsson-RT0_pCTjBP4-unsplash',
            'jurien-huggins-CVvtZHnysGg-unsplash',
            'kevin-canlas-EfatMNgAAUw-unsplash',
            'krists-luhaers-N7G0LNl5e1g-unsplash',
            'lance-reis-uBMlyOFy6go-unsplash',
            'liam-tucker-cVMaxt672ss-unsplash',
            'lidya-nada-tXz6g8JYYoI-unsplash',
            'luca-bravo-3Z70SDuYs5g-unsplash',
            'luna-rico-UbN0sWbROuE-unsplash',
            'magnus-ostberg-AKLmn_MSAbA-unsplash',
            'mark-tegethoff-lX-sxatAvqc-unsplash',
            'matt-ragland-02z1I7gv4ao-unsplash',
            'mayur-gala-2PODhmrvLik-unsplash',
            'minh-pham-lB9ylP8e9Sg-unsplash',
            'mohamed-nohassi-odxB5oIG_iA-unsplash',
            'moises-alex-LkZRTThjBHA-unsplash',
            'nice-m-nshuti-cTqxDBsEv3g-unsplash',
            'nick-nice-n78DsGWsOm8-unsplash',
            'nine-koepfer-zosE9lAYQlo-unsplash',
            'nirmal-rajendharkumar-g-lUKR6Ac-I-unsplash',
            'petr-urbanek-7c-Cdz4HuLw-unsplash',
            'priscilla-du-preez-nF8xhLMmg0c-unsplash',
            'rana-sawalha-W_-6PWGbYaU-unsplash',
            'ray-rui-SyzQ5aByJnE-unsplash',
            'redd-f-qFEqgc9X3fw-unsplash',
            'redd-f-t8ts5bNQyWo-unsplash',
            'ren-ran-bBiuSdck8tU-unsplash',
            'retrosupply-jLwVAUtLOAQ-unsplash',
            'sarah-dorweiler-7tFlUFGa7Dk-unsplash',
            'saulo-mohana-fGXh4-axxHA-unsplash',
            'sebastien-goldberg-FQtJYfD5FME-unsplash',
            'senjuti-kundu-JfolIjRnveY-unsplash',
            'sigmund-eTgMFFzroGc-unsplash',
            'simon-berger-twukN12EN7c-unsplash',
            'sincerely-media-ylveRpZ8L1s-unsplash',
            'spacejoy-IH7wPsjwomc-unsplash',
            'theodore-de-liu-9g63f8rpiPc-unsplash',
            'toa-heftiba-ip9R11FMbV8-unsplash',
            'tony-liao-vlqOuSuc--A-unsplash',
            'victoria-alexandrova-qCOCy4T-j3g-unsplash',
            'victor-larracuente-4vl6TQYUwvI-unsplash',
            'vinicius-amnx-amano-JDY_QTaNscM-unsplash',
            'zoe-OJnaMT6EmXY-unsplash',
        ];
    }
}
