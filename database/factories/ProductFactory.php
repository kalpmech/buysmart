<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'price' =>$this->faker->numberBetween($min = 1, $max = 200),
            'rate_val' =>$this->faker->numberBetween($min = 1, $max = 200),
            'rate_count' =>$this->faker->numberBetween($min = 1, $max = 200),
            'sale_counts' =>$this->faker->numberBetween($min = 1, $max = 200),
            'view_counts' =>$this->faker->numberBetween($min = 1, $max = 200),
            'brand' => $this->faker->company,
            'user_id' => 1,
            'category_id' => $this->faker->numberBetween($min = 1, $max = 3),
            'tags' => $this->faker->text,
            'features' => $this->faker->text,
            'description' => $this->faker->text,
        ];
    }
}
