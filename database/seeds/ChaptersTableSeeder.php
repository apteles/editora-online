<?php

use CodeEduBook\Entities\Book;
use Illuminate\Database\Seeder;
use CodeEduBook\Entities\Chapter;

class ChaptersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = Book::all();

        foreach ($books as $book) {
            factory(Chapter::class, 5)->create()->each(function ($chapter) use ($book) {
                $chapter->book_id = $book->id;
                $chapter->save();
            });
        }
    }
}
