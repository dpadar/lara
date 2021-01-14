<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstname' => $this->faker->firstName(),
			'lastname' => $this->faker->lastName(),
			'username'=> $this->faker->unique()->userName(),
			'country_code' => $this->faker->randomElement(['ua', 'uk', 'us']),
			'password' => Hash::make('P@ssw0rd'),
			'admin' => false,
            'remember_token' => Str::random(10),
        ];
    }
}
