<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\User; 
use App\Manager; 
use App\Employee; 
use App\Category; 

class MainController extends Controller
{
    //
    public function index() {

        $usrID = Auth::user();
        $id=$usrID->id;

        ###dump($id);
        ###if($id) {Session::flash('message', $id[0]->name. ' logged on.');}


        $employees = Employee::where('team_id', '=', $id)->get();

    return view('login.index')->with(['employees' => $employees]); 
    }


    public function tologin() {

        return redirect('/login');
    }     

    //
    public function access() {

        $employees = Employee::all(); 
        return view('login.mgrportal')->with(['employees' => $employees]); 
    }
    
    //
    public function mgrportal() {

        $employees = Employee::all();
        dump($employees);
        return view('login.mgrportal')->with(['employees' => $employees]); 
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
    * /employee/{id}
    */
    public function show($id) {

        $employee = Employee::find($id);

        if(!$employee) {
            Session::flash('message', 'The employee you searched for could not be found.');
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

        $usrID = Auth::user();
        $id=$usrID->id;

        $manager = Manager::where('id', '=', $id)->get();

###dd($manager[0]->last_name);
###dd($id);

        $messages = [
            'teamID' => $id,
        ];

        $this->validate($request, [
            'title' => 'required|min:10',
            'firstName' => 'required|alpha|min:2',
            'lastName' => 'required|alpha|min:2',
            'teamID' => 'not_in:0',
        ], $messages);



###            'teamID' => 'not_in:0',


        # Add new book to database
        $employee = new Employee();
        $employee->title = $request->title;
        $employee->first_name = $request->firstName;
        $employee->last_name = $request->lastName;
        $employee->team_id = $id;
###dd($id);
        $employee->save();

        # Now handle tags.
        # Note how the book has to be created (save) first *before* tags can
        # be added; this is because the tags need a book_id to associate with
        # and we don't have a book_id until the book is created.
        $tags = ($request->tags) ? : [];
        $employee->categories()->sync($tags);
        $employee->save();

        Session::flash('message','Employee '.$employee->first_name.' '.$employee->last_name.' was added to team '.$manager[0]->first_name.' '.$manager[0]->last_name.'. ');

        return redirect('/');
    }

/**
* POST
* /employees/edit
* Process form to edit a book
*/
##############################################################################################
# Edit selected employee
##############################################################################################
public function edit(Request $request) {

    $id=$request->id;
    if($request->id==0) {
        Session::flash('message', 'The selected employee is not valid.');
        return redirect('/index');
    }


    $edit_delete=$request->edit_delete;
    if($request->edit_delete=='delete') {
        Session::flash('message', 'Employee found.');
        return redirect('/initdelete/'.$request->id);
    }

    # Get this employee and eager load its tags
    $employee = Employee::with('categories')->find($id);

    # Get all the possible tags so we can include them with checkboxes in the view
    $categoriesForCheckboxes = Category::getCategoriesForCheckboxes();

    # Create a simple array of just the tag names for tags associated with this book;
    # will be used in the view to decide which tags should be checked off
    $categoriesForThisEmployee = [];

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
##############################################################################################
#
##############################################################################################
public function saveEdits(Request $request) {

        $employee = Employee::find($request->id);

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

        Session::flash('message', 'Your changes to '.$employee->first_name. ' '.$employee->last_name. ' were saved.');

        return redirect('/security/'.$request->id);

    }

    /**
    * GET
    * Page to confirm deletion
    */
    public function confirmDeletion($id) {

        # Get employee to be deleted
        $employee = Employee::find($id);

        if(!$employee) {
            Session::flash('message', 'Employee not found.');
            return redirect('/index');
        }

        Session::flash('message', 'Employee '.$employee->first_name. ' '.$employee->last_name.' was deleted.');

        return view('employees.delete')->with('employee', $employee);
    }

    /**
    * POST
    * Actually delete the book
    */
##############################################################################################
# Delete employee
##############################################################################################
    public function delete(Request $request) {

        # Get the employee to be deleted
        $employee = Employee::find($request->id);
###($employee);
        if(!$employee) {
            Session::flash('message', 'Deletion failed; the employee to be deleted was not found.');
            return redirect('/employees');
        }

        $employee->categories()->detach();

        $employee->delete();

        # Finish

        Session::flash('message', 'Employee '.$employee->first_name. ' '.$employee->last_name.' was deleted.');

        return redirect('/');
    }

} # end of class


