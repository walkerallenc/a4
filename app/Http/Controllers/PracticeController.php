<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class PracticeController extends Controller
{
    //

public function practice1() { 
   # Instantiate a new Book Model object 

   $book = new Book(); 

   # Set the parameters 
   # Note how each parameter corresponds to a field in the table 

   $book->title = "Harry Potter and the Sorcerer's Stone"; 
   $book->author = 'J.K. Rowling'; 
   $book->published = 1997; 
   $book->cover = 'http://prodimage.images-bn.com/pimages/9780590353427_p0_v1_s484x700.jpg';
 
$book->purchase_link = 'http://www.barnesandnoble.com/w/harry-potter-and-the-sorcerers-stone-j-k-rowling/1100036321?ean=9780590353427'; 

# Invoke the Eloquent `save` method to generate a new row in the 
# `books` table, with the above data 

$book->save(); dump('Added: '.$book->title); 
} 

public function practice2() {

#    $book = new Book();
#    $books = $book->where('title', 'LIKE', '%Harry Potter%')->get();

# $books = Book::where('title', 'LIKE', '%Harry Potter%')->get();

# Get only books published after 1950
#   `where` is the constraint method
#   `get` is the fetch method
$results = Book::where('published', '>', 1950)->get();
# dump($results->toArray()); # Study the results

# Get only books that were authored by F. Scott Fitzgerald
    # `where` is the constraint method
    # `get` is the fetch method
$results = Book::where('author', '=', 'F. Scott Fitzgerald')->get();
#dump($results->toArray()); # Study the results

# Get the *first* book in the table that was authored by F. Scott Fitzgerald
    # `where` & `orderBy` are the constraint methods
    # `first` is the fetch method
$results = Book::where('author', '=', 'F. Scott Fitzgerald')->orderBy('created_at')->first();
#dump($results->toArray()); # Study the results

# Get only books that were published after 1950 *and* authored by F. Scott Fitzgerald
    # `where` is the constraint method, and it's used twice
    # `get` is the fetch method
$results = Book::where('published', '<', 1930)->where('author', '=', 'F. Scott Fitzgerald')->get();
#dump($results->toArray()); # Study the results

# Get all the books
    # There is no constraint method
    # `all` is the fetch method
$results = Book::all();
#dump($results->toArray()); # Study the results


# First get a book to update
$book = Book::where('author', 'LIKE', '%Scott%')->first();

if(!$book) {
#    dump("Book not found, can't update.");
}
else {

    # Change some properties
    $book->title = 'The Really Great Gatsby';
    $book->published = '2025';

    # Save the changes
#    $book->save();

#    dump('Update complete; check the database to confirm the update worked.');
}    

#    if($books->isEmpty()) {
#        dump('No matches found');
#    }
#    else {
#        foreach($books as $book) {
#            dump($book->title);
#        }
#    }
}

public function practice3() {


# Get all rows
#$result = Book::all();
#dump($result->toArray());

# Get a row by id
#$result = Book::find(1);
#dump($result);

# Throw an exception if the lookup fails
#$result = Book::findOrFail(9999);
#dump($result->toArray());

# Get all rows with a `where` constraint using fuzzy matching
$result = Book::where('title', 'LIKE', '%Gatsby%')->get();
dump($result->toArray());

# Get all rows with a `where` constraint using exact matching
$result = Book::where('title', '=', 'The Great Gatsby')->get();
dump($result->toArray());

# Get rows with a `orderBy` constraint
# By default order is ascending
$result = Book::orderBy('published')->get();
dump($result->toArray());

# A second param can be passed to `orderBy` constraint to specify descending order
$result = Book::orderBy('published', 'desc')->get();
dump($result->toArray());

# `orderBy` constraints can be chained to order by multiple rows
$result = Book::orderBy('published')->orderBy('title', 'desc')->get();
dump($result->toArray());

# Chain two `where` constraints
$result = Book::where('published', '>', '1960')->where('id', '<', 5 )->get();
dump($result->toArray());

# Chain a `where` and a `orWhere` constraint
$result = Book::where('published', '>', '1960')->orWhere('id', '<', 5 )->get();
dump($result->toArray());

# `whereIn` constraint
$result = Book::whereIn('id', [1, 2])->get();
dump($result->toArray());

# Get just the first result of a query by using the `first` fetch method
$result = Book::where('title', 'LIKE', '%Gatsby%')->orderBy('created_at')->first();
dump($result);

# Throw an exception if the query fails
$result = Book::where('title', '=', 'The Great Gatsbyyyyy')->firstOrFail();
dump($result->toArray());

# Count how many rows match a `where` constraint using the `count` fetch method
$result = Book::where('title', 'LIKE', '%Gatsby%')->count();
dump($result);

# Limit the amount of results a query will return
$result = Book::where('published', '>', 1800)->limit(2)->get();
dump($result->toArray());

# Get a single column's value from the first result of a query
$result = Book::where('published', '>', 1800)->orderBy('published')->value('title');
dump($result);

# Determine if a row exists using the `exists` fetch method (returns a boolean value)
$result = Book::where('title', '=', 'The Great Gatsby')->exists();
dump($result);

# Execute a raw SQL select
$result = Book::raw('SELECT * FROM books WHERE title LIKE %Gatsby%')->get();
dump($result->toArray());

# Delete a row by id
$result = Book::destroy(1);
dump($result);

# Delete any rows matching a `where` constraint
$result = Book::where('title', '=', 'The Great Gatsby')->delete();
dump($result);
}


public function practice4() {
# Limit the amount of results a query will return
$result = Book::where('published', '>', 1800)->orderBy('published','desc')->limit(5)->get();
dump($result->toArray());
}


}
