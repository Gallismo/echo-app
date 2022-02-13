<?php

namespace Database\Factories;

use App\Models\category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class categoryFactory extends Factory
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
            'description' => $this->faker->realText(50),
            'slug' => Str::slug($name)."-".substr(time(), -5)
        ];
    }

    protected $model = category::class;
}
