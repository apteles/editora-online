<?php

use CodeEduBook\Entities\Book;
use Illuminate\Database\Seeder;
use CodeEduBook\Entities\Category;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::all();
        factory(Book::class, 50)->create()->each(function ($book) use ($categories) {
            $categoriesRandom = $categories->random(4);
            $book->categories()->sync($categoriesRandom->pluck('id')->all());
        });
    }
}
