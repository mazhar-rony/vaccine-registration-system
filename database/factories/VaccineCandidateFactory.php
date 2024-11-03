<?php

namespace Database\Factories;

use App\Models\VaccineCenter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VaccineCandidate>
 */
class VaccineCandidateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'              => fake()->name(),
            'email'             => fake()->unique()->safeEmail(),
            'phone'             => fake()->e164PhoneNumber(),
            'nid'               => fake()->unique()->numberBetween(1000000000, 9999999999),
            'vaccine_center_id' => VaccineCenter::pluck('id')->random(),
        ];
    }
}
