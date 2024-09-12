<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    protected static $index = 0;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $books = [
            ['title' => 'Harry Potter and the Sorcerer\'s Stone', 'author' => 'J.K. Rowling', 'year' => 1997],
            ['title' => 'The Hobbit', 'author' => 'J.R.R. Tolkien', 'year' => 1937],
            ['title' => 'The Catcher in the Rye', 'author' => 'J.D. Salinger', 'year' => 1951],
            ['title' => 'Pride and Prejudice', 'author' => 'Jane Austen', 'year' => 1813],
            ['title' => 'To Kill a Mockingbird', 'author' => 'Harper Lee', 'year' => 1960],
            ['title' => '1984', 'author' => 'George Orwell', 'year' => 1949],
            ['title' => 'The Great Gatsby', 'author' => 'F. Scott Fitzgerald', 'year' => 1925],
            ['title' => 'Moby Dick', 'author' => 'Herman Melville', 'year' => 1851],
            ['title' => 'The Little Prince', 'author' => 'Antoine de Saint-Exupéry', 'year' => 1943],
            ['title' => 'The Lord of the Rings', 'author' => 'J.R.R. Tolkien', 'year' => 1954],
        ];

        $book = $books[self::$index];

        self::$index++;

        if (self::$index >= count($books)) {
            self::$index = 0;
        }

        return $book;
    }
}
