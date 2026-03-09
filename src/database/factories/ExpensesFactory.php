<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expenses>
 */
class ExpensesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'category_id' => Category::factory(),
           'amount' => fake()->randomFloat(2, 0, 1000),
           'date' => fake()->date(),
           'description' => fake()->sentence(),
           'user_id' => User::factory()
        ];
    }
}
