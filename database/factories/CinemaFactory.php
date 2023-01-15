<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Cinema;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cinema>
 */
class CinemaFactory extends Factory
{
    protected $model = Cinema::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'estado' => fake()->name(),
            'cidade' => fake()->name(),
            'criado_em' => Carbon::today()->subDays(rand(0, 365))
        ];
    }
}
