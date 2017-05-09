<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Manager; 
use App\Employee; 
use App\Category; 

class LoginController extends Controller
{
    //
    public function index() {
        $managersForDropdown = Manager::getManagersForDropdown();
        $mgrID=($managersForDropdown[2][0]);
dump($mgrID);


        ###$employees = Employee::all();

        $employees = Employee::where('team_id', '=', $mgrID )->get();

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

   /**
    * GET
    * /books/{id}
    */
###    public function show($id) {
###
###        $book = Book::find($id);
###
###        if(!$book) {
###            Session::flash('message', 'The book you requested could not be found.');
###            return redirect('/');
###        }
###
###        return view('books.show')->with([
###            'book' => $book,
###        ]);
###    }
   /**
    * GET
    * /booksXXXXXX/{id}
    */
    public function show($id) {

        $employee = Employee::find($id);

        if(!$employee) {
 ###           Session::flash('message', 'The book you requested could not be found.');
            return redirect('/');
        }

        return view('employees.show')->with([
            'employee' => $employee,
        ]);
    }


    /**
    * GET
    * /employees/new
    * Display the form to add a new book
    */
    public function createNewEmployee(Request $request) {
        
        $categoriesForCheckboxes = Category::getCategoriesForCheckboxes();

        return view('employees.new')->with([
            'categoriesForCheckboxes' => $categoriesForCheckboxes
        ]);
    }

    /**
    * POST
    * /books/new
    * Process the form for adding a new book
    */
    public function saveNewEmployee(Request $request) {
        # Custom error message
        $messages = [
            'teamID.not_in' => 'Manager not selected.',
        ];

        $this->validate($request, [
            'title' => 'required|min:10',
            'firstName' => 'required|alpha|min:2',
            'lastName' => 'required|alpha|min:2',
            'teamID' => 'not_in:0',
        ], $messages);

        # Add new book to database
        $employee = new Employee();
        $employee->title = $request->title;
        $employee->first_name = $request->firstName;
        $employee->last_name = $request->lastName;
        $employee->team_id = $request->teamID;
        $employee->save();

        # Now handle tags.
        # Note how the book has to be created (save) first *before* tags can
        # be added; this is because the tags need a book_id to associate with
        # and we don't have a book_id until the book is created.
        $tags = ($request->tags) ? : [];
        $employee->categories()->sync($tags);
        $employee->save();

###        Session::flash('message', 'The book '.$request->title.' was added.');

        # Redirect the user to book index
###       return redirect
###        return redirect('/security/'.$request->id);
        return redirect('/');

    }

/**
* POST
* /books/edit
* Process form to edit a book
*/
public function edit(Request $request) {
    ###$managersForDropdown = Manager::getManagersForDropdown();
    ###dd($managersForDropdown[2][0]);

###dd($id);

    $id=$request->id;
    if($request->id==0) {
###     Session::flash('message', 'Book not found.');
        return redirect('/security/new');
    }


    $edit_delete=$request->edit_delete;
    if($request->edit_delete=='delete') {
###     Session::flash('message', 'Book not found.');
        return redirect('/initdelete/'.$request->id);
    }


    # Get this book and eager load its tags
$employee = Employee::with('categories')->find($id);
###dd($employee);

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

    return view('employees.edit')
        ->with([
            'employee' => $employee,
            'categoriesForCheckboxes' => $categoriesForCheckboxes,
            'categoriesForThisEmployee' => $categoriesForThisEmployee,
        ]);
}


/**
* POST
* /books/edit
* Process form to save edits to a book
*/
public function saveEdits(Request $request) {

        $employee = Employee::find($request->id);
###        dd($request->id);

        $employee = Employee::find($request->id);
###        dd($employee);

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

        # Above if/else could be condensed down to this: $tags = ($request->tags)?: [];

        # Sync tags
        $employee->categories()->sync($tags);
        $employee->save();

###        Session::flash('message', 'Your changes to '.$employee->title.' were saved.');
###     return redirect('/');
###     return redirect('/save'.$request->id);
        return redirect('/security/'.$request->id);

    }


    /**
    * GET
    * Page to confirm deletion
    */
###    public function confirmDeletion($id) {
###
###        # Get the book they're attempting to delete
###        $book = Book::find($id);
###
###        if(!$book) {
###            Session::flash('message', 'Book not found.');
###            return redirect('/books');
###        }
###
###        return view('books.delete')->with('book', $book);
###    }
###
###
    /**
    * GET
    * Page to confirm deletion
    */
    public function confirmDeletion($id) {

        # Get employee to be deleted
        $employee = Employee::find($id);

        if(!$employee) {
            Session::flash('message', 'Book not found.');
            return redirect('/booksXXXXX');
        }

        return view('employees.delete')->with('employee', $employee);
    }



    /**
    * POST
    * Actually delete the book
    */
###    public function delete(Request $request) {
###
###        # Get the book to be deleted
###        $book = Book::find($request->id);
###
###        if(!$book) {
###            Session::flash('message', 'Deletion failed; book not found.');
###            return redirect('/books');
###        }
###
###        $book->tags()->detach();
###
###        $book->delete();
###
###        # Finish
###        Session::flash('message', $book->title.' was deleted.');
###        return redirect('/books');
###    }
###
###}
    /**
    * POST
    * Actually delete the book
    */
    public function delete(Request $request) {

###dd($request);

        # Get the employee to be deleted
        $employee = Employee::find($request->id);
($employee);
        if(!$employee) {
###            Session::flash('message', 'Deletion failed; book not found.');
            return redirect('/employees');
        }

        $employee->categories()->detach();

        $employee->delete();

        # Finish
###        Session::flash('message', $employee->title.' was deleted.');
        return redirect('/');
    }

} # end of class


