<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'invoice_number' => Str::upper(Str::random(6)) . '-' . $this->faker->unique()->numberBetween(100000, 999999), // Generates a random invoice number
            'amount' => $this->faker->randomFloat(2, 50, 1000), // Random amount between 50 and 1000
            'customer_email' => $this->faker->unique()->safeEmail, // Unique customer email
            'status' => $this->faker->randomElement(['Draft', 'Paid', 'Outstanding', 'Due']), // Random status
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
