<?php

use Illuminate\Database\Seeder;
use App\Book;
use App\Author;


class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    ### [...Redacted code that sets up the $books array]
        # Load json file into PHP array
        $books = json_decode(file_get_contents(database_path().'/books.json'), True);

        # Initiate a new timestamp we can use for created_at/updated_at fields
        $timestamp = Carbon\Carbon::now()->subDays(count($books));
    ###

    foreach($books as $title => $book) {
        # First, figure out the id of the author we want to associate with this book

        # Extract just the last name from the book data...
        # F. Scott Fitzgerald => ['F.', 'Scott', 'Fitzgerald'] => 'Fitzgerald'
        $name = explode(' ', $book['author']);
        $lastName = array_pop($name);

        # Find that author in the authors table
        $author_id = Author::where('last_name', '=', $lastName)->pluck('id')->first();

        Book::insert([
            'created_at' => $timestamp, #ForThisBook,
            'updated_at' => $timestamp, #ForThisBook,
            'title' => $title,
            #'author' => $book['author'], # Remove the old way we stored the author
            'author_id' => $author_id, # Add the new way we store the author
            'published' => $book['published'],
            'cover' => $book['cover'],
            'purchase_link' => $book['purchase_link'],
            ]);

        }
    }
}
