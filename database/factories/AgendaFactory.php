<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Agenda>
 */
class AgendaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = now();
        $endDate = now()->addMonths(3);

        return [
            'titulo' => $this->faker->name(),
            'descricao' => $this->faker->text(),
            'data' => $this->faker->dateTimeBetween($startDate, $endDate),
        ];
    }
}
