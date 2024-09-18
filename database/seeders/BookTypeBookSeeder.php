<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BookTypeBook;

class BookTypeBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BookTypeBook::factory()->count(500)->create();
    }
}
