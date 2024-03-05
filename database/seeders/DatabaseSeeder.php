<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Tag;
use App\Models\Author;
use App\Models\Noticia;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Author::factory(5)->create();

        Tag::factory(5)->create();

        // Seed noticias and associate tags
        Noticia::factory(10)->create()->each(function ($noticia) {
            $tags = Tag::inRandomOrder()->limit(rand(1, 3))->get();
            $noticia->tags()->attach($tags);

            $author = Author::inRandomOrder()->first();
            $noticia->author()->associate($author)->save();
        });
    }
}
