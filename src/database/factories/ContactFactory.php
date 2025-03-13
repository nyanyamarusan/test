<?php

namespace Database\Factories;

use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = Faker::create('ja_JP');

        return [
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'gender' => $faker->numberBetween(1,3),
            'email' => $faker->unique->safeEmail,
            'tel' => $faker->phoneNumber,
            'address' => $faker->address,
            'building' => $faker->secondaryAddress,
            'detail' => $faker->text(rand(10, 255)),
            'category_id' => $faker->numberBetween(1,5),
        ];
    }
}
