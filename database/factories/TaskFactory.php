<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    #[ArrayShape(['subject' => "string", 'map' => "int", 'legend' => "int", 'contents' => "string", 'limited_at' => "string"])] public function definition(): array
    {
        return [
            'subject' => $this->faker->name,
            'map' => 1,
            'legend' => 1,
            'contents' => $this->faker->name,
            'limited_at' => '2020-06-22 00:00:00',
        ];
    }
}
