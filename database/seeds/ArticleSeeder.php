<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('articles')->delete();

        for ($i = 1; $i <= 100; $i++) {
            \App\Article::create([
                'title' => 'Title_' . $i,
                'author' => 'Author_' . $i,
                'body' => 'Article Body_' . $i,
            ]);
        }
    }
}
