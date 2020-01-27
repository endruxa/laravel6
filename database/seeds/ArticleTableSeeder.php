<?php

use App\Article;
use Illuminate\Database\Seeder;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Article::truncate();
        $faker = \Faker\Factory::create();

        for($i=1;$i<=50;$i++){
            Article::create([
                'title' => $faker->sentence,
                'description' => $faker->paragraph
            ]);
        }
    }
}
