<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{


    protected $model = Company::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'city_id' => City::factory(),
            'name' => $this->faker->company(),
            'address' => $this->faker->address,
            'website' => $this->faker->url,
        ];
    }
}
