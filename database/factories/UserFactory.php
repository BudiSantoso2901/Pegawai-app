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
        // return [
        //     'nama' => $this->faker->name,
        //     'posisi' => $this->faker->jobTitle,
        //     'perusahaan' => $this->faker->company,
        //     'nomer_hp' => $this->faker->phoneNumber,
        //     'type' => $this->faker->randomElement([0, 1]),
        //     'email' => $this->faker->unique()->safeEmail,
        //     'password' => Hash::make('password'),
        //     'remember_token' => Str::random(10),
        // ];
        return [
            'nama' => $this->faker->name,
            'posisi' => $this->faker->jobTitle,
            'perusahaan' => $this->faker->company,
            'nomer_hp' => $this->faker->phoneNumber,
            'type' => $this->faker->randomElement([0, 1]),
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
