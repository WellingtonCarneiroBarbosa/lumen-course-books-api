<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition(): array
    {
    	return [
    	    'title'         => $this->faker->sentence(3, true),
            'description'   => $this->faker->sentence(50, true),
            'price'         => $this->faker->biasedNumberBetween(25, 300),
            'author_id'     => $this->faker->biasedNumberBetween(1, 50),
    	];
    }
}
