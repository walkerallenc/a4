<?php

use Illuminate\Database\Seeder;
use App\Employee; 
use App\Category; 


class EmployeeCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() { 
        # First, create an array of all the books we want to associate tags with 
        # The *key* will be the book title, and the *value* will be an array of tags. 
        # Note: purposefully omitting the Harry Potter books to demonstrate untagged books 
        $employees =[
        'Williams' => ['ring','earring','necklace','bracelet'], 
        'Reilly' => ['ring','earring','necklace','pendant'], 
        'Anderson' => ['ring','earring','necklace','pendant'] 
        ]; 

        # Now loop through the above array, creating a new pivot for each book to tag 
        foreach($employees as $title => $tags) {
            # First get the book 
            $employee = Employee::where('last_name','like',$title)->first(); 
            # Now loop through each tag for this book, adding the pivot 
            foreach($tags as $tagName) { 
               $tag = Category::where('name','LIKE',$tagName)->first(); 
               # Connect this tag to this book 
               $employee->categories()->save($tag); 
            } 
        } 
    }

}
