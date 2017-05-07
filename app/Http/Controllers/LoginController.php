<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book; 
use App\Employee; 
use App\Category; 

class LoginController extends Controller
{
    //
    public function index() {
        $employees = Employee::all();
    return view('login.index')->with(['employees' => $employees]); 
    }

    //
    public function access() {

### IF LOGIN ATTEMPT PASSES
###     DO THIS
        #$books = Book::all();
        $employees = Employee::all(); 
##dd($employees);
        return view('login.mgrportal')->with(['employees' => $employees]); 
### ELSE
###    DO THIS
### END IF
    }

    public function mgrportal() {

### IF LOGIN ATTEMPT PASSES
###     DO THIS
        #$books = Book::all();
        $employees = Employee::all();
        dump($employees);
        return view('login.mgrportal')->with(['employees' => $employees]); 
### ELSE
###    DO THIS
### END IF
    }

###public function edit($id = null) {
###
###    # Get this book and eager load its tags
###    $book = Book::with('tags')->find($id);
###
###    # Get authors
###    $authorsForDropdown = Author::authorsForDropdown();
###
###    # Get all the possible tags so we can include them with checkboxes in the view
###    $tagsForCheckboxes = Tag::getTagsForCheckboxes();
###
###    # Create a simple array of just the tag names for tags associated with this book;
###    # will be used in the view to decide which tags should be checked off
###    $tagsForThisBook = [];
###    foreach($book->tags as $tag) {
###        $tagsForThisBook[] = $tag->name;
###    }
###    # Results in an array like this: $tagsForThisBook => ['novel','fiction','classic'];
###
###    return view('book.edit')
###        ->with([
###            'book' => $book,
###            'authorsForDropdown' => $tagsForThisBook,
###            'tagsForCheckbox' => $tagsForCheckboxes,
###            'tagsForThisBook' => $tagsForThisBook,
###        ]);
###}

/**
* POST
* /books/edit
* Process form to edit a book
*/
###public function edit($id = null) {
public function edit(Request $request) {
##dd($request);

$id=$request->id;

    # Get this book and eager load its tags
    $employee = Employee::with('categories')->find($id);
###dd($employee);
    # Get authors
###    $authorsForDropdown = Author::authorsForDropdown();

    # Get all the possible tags so we can include them with checkboxes in the view
    $categoriesForCheckboxes = Category::getCategoriesForCheckboxes();
###dd($categoriesForCheckboxes);
    # Create a simple array of just the tag names for tags associated with this book;
    # will be used in the view to decide which tags should be checked off
    $categoriesForThisEmployee = [];
###dd($employee);
    foreach($employee->categories as $tag) {
        $categoriesForThisEmployee[] = $tag->name;
    }
    # Results in an array like this: $tagsForThisBook => ['novel','fiction','classic'];

    return view('employees.edit')
        ->with([
            'employee' => $employee,
            ###'authorsForDropdown' => $tagsForThisBook,
            'categoriesForCheckboxes' => $categoriesForCheckboxes,
            'categoriesForThisEmployee' => $categoriesForThisEmployee,
        ]);
}


### /**
###    * POST
###    * /books/edit
###    * Process form to save edits to a book
###    */
###    public function saveEdits(Request $request) {
###
###        # Custom error message
###        $messages = [
###            'author_id.not_in' => 'Author not selected.',
###        ];
###
###        $this->validate($request, [
###            'title' => 'required|min:3',
###            'published' => 'required|numeric',
###            'cover' => 'required|url',
###            'purchase_link' => 'required|url',
###            'author_id' => 'not_in:0'
###        ], $messages);
###
###        $book = Book::find($request->id);
###
###        # Edit book in the database
###        $book->title = $request->title;
###        $book->published = $request->published;
###        $book->cover = $request->cover;
###        $book->purchase_link = $request->purchase_link;
###        $book->author_id = $request->author_id;
###
###        # If there were tags selected...
###        if($request->tags) {
###            $tags = $request->tags;
###        }
###
###        # If there were no tags selected (i.e. no tags in the request)
###        # default to an empty array of tags
###        else {
###            $tags = [];
###        }
###
###        # Above if/else could be condensed down to this: $tags = ($request->tags) ?: [];
###
###        # Sync tags
###        $book->tags()->sync($tags);
###        $book->save();
###
###        Session::flash('message', 'Your changes to '.$book->title.' were saved.');
###        return redirect('/books/edit/'.$request->id);
###
###    }
###}

/**
* POST
* /books/edit
* Process form to save edits to a book
*/
    public function saveEdits(Request $request) {

###        # Custom error message
###        $messages = [
###            'author_id.not_in' => 'Author not selected.',
###        ];
###
###        $this->validate($request, [
###            'title' => 'required|min:3',
###            'published' => 'required|numeric',
###            'cover' => 'required|url',
###            'purchase_link' => 'required|url',
###            'author_id' => 'not_in:0'
###        ], $messages);
###

        $employee = Employee::find($request->id);
###        dd($request->id);

        $employee = Employee::find($request->id);
###        dd($employee);

###
###        # Edit book in the database
###        $book->title = $request->title;
###        $book->published = $request->published;
###        $book->cover = $request->cover;
###        $book->purchase_link = $request->purchase_link;
###        $book->author_id = $request->author_id;

###   dd($request);
###   dd($request->tags);
        # If there were tags selected...
        if($request->tags) {
            $tags = $request->tags;
        }

        # If there were no tags selected (i.e. no tags in the request)
        # default to an empty array of tags
       else {
            $tags = [];
        }

        # Above if/else could be condensed down to this: $tags = ($request->tags) ?: [];

        # Sync tags
        $employee->categories()->sync($tags);
        $employee->save();

###        Session::flash('message', 'Your changes to '.$employee->title.' were saved.');
###     return redirect('/');
###     return redirect('/save'.$request->id);
        return redirect('/security/'.$request->id);

    }
###}

#<?php
#
#namespace DWA;
#
#class Security {
#
#
#    /**
#	* Properties
#	*/
#    private $users;
#
#
#    /**
#	*
#	*/
#    public function __construct($jsonPath) {
#
#        $usersJSON = file_get_contents($jsonPath);
#        $this->users = json_decode($usersJSON, true);
#    }
#
#    /**
#	*
#	*/
#    public function getUser(string $potentialuser, $caseSensitive = false) 
#      {
#        $authorizedUser = [];
#        foreach($this->users as $thisUser => $user) 
#         {
#           if($caseSensitive) 
#           {
#               $match = $thisUser == $user;
#           }
#           else 
#           {
#               $match = strtolower($thisUser) == strtolower($potentialuser);
#           }
#            if($match) 
#                $authorizedUser[] = $user;
#        }
##dump($authorizedUser);
#        return $authorizedUser;
#    }
#
#
#
#
#
} # end of class


