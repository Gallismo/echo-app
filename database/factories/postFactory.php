<?php

namespace Database\Factories;

use App\Models\author;
use App\Models\post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class postFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->word();

        return [
            'name' => $name,
            'image' => $this->faker->imageUrl(),
            'anounce' => $this->faker->date(),
            'text' => $this->faker->realText(400),
            'author' => author::inRandomOrder()->first()->id,
            'slug' => Str::slug($name)."-".substr(time(), -5)
        ];
    }

    protected $model = post::class;
}
