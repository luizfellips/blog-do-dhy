<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'corpo' => fake()->text(255),
        ];
    }
}
