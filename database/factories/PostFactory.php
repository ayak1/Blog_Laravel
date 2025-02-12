<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'=>fake()->sentence(rand(5, 10)),
            'text' =>fake()->realTextBetween(300, 500),
            // 'user_id'=>User::factory() //this wil generate a new user each time we create new post
            'user_id'=>User::all()->random()->id, //this will attach it to random user already created
            // 'user_id' => Auth::id(),
        ];
    }
}
