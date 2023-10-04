<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\WithFaker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    use WithFaker;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'name'=>$this->faker->userName(),
            'category'=>$this->faker->numberBetween($min = 1, $max = 3),
            'description'=>$this->faker->text($maxNbChars = 200),
            'date'=>Carbon::now(),
            'time'=>Carbon::now()->format('h:i:s'),
        ];
    }
}
