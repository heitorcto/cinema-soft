<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Sala;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sala>
 */
class SalaFactory extends Factory
{
    protected $model = Sala::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'sala' => rand(1, 20),
            'cinema_id' => 7
        ];
    }
}
