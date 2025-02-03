<?php

namespace Database\Factories;

// use App\Models\Bin;
use App\Models\Bins;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BinsFactory extends Factory
{
    protected $model = Bins::class;

    public function definition()
    {
        return [
            'name' => $this->faker->streetName() . ' Bin',
            'location' => $this->faker->latitude() . ',' . $this->faker->longitude(),
            'fill_level' => $this->faker->numberBetween(0, 100),
            'battery_level' => $this->faker->numberBetween(20, 100),
            'is_connected' => $this->faker->boolean(85),
            'last_communication' => $this->faker->dateTimeBetween('-1 week', 'now')
        ];
    }

    // États personnalisés
    public function disconnected()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_connected' => false,
                'battery_level' => 0
            ];
        });
    }
    public function full(): static
    {
        return $this->state(fn(array $attributes) => [
            'fill_level' => 100
        ]);
    }

    public function withUser(): static
    {
        return $this->state([
            'user_id' => User::factory()->create()->id
        ]);
    }
}
