<?php

namespace Database\Factories;

use App\Models\author;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class authorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $genders = ['male', 'female'];
        $gender = $genders[array_rand($genders)];
        $lastName = $this->faker->lastName($gender);
        $middleName = $this->faker->middleName($gender);
        $firstName = $this->faker->firstName($gender);

        $FIO = [$lastName, $firstName, $middleName];
        $FIO = implode(' ', $FIO);

        return [
            'first_name' => $firstName,
            'middle_name' => $middleName,
            'last_name' => $lastName,
            'avatar' => $this->faker->imageUrl(),
            'birth_year' => $this->faker->year(),
            'biography' => $this->faker->realText(),
            'slug' => Str::slug($FIO)
        ];
    }

    protected $model = author::class;
}
