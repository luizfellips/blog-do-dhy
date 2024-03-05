<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Noticia>
 */
class NoticiaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $titulo = $this->faker->sentence();
        $slug = Str::slug($titulo);

        return [
            'titulo' => $titulo,
            'slug' => $slug,
            'subtitulo' => fake()->sentence(12),
            'corpo' => fake()->text(1500),
        ];
    }
}
