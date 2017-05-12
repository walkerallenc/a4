<?php
################################################################
#CSCI E-15 Dynamic Web Applications                            #
#Assignment A4                                                 #
#Developer: Allen C. Walker                                    #
################################################################

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\User; 
use App\Manager; 
use App\Employee; 
use App\Category; 

##################################################################################################
### This MainController controller class contains the logic regarding the managers table.      ###
### I)  "index" function that returns all employees assigned to the logged in manager.         ###
### II) "tologin" function that redirects users to the login route.                            ###
### III) "tologin" function that redirects users to the login route.                           ###
### IV) "createNewEmployee" function that returns categories to be assigned a to new employee. ###
##################################################################################################
class MainController extends Controller
{

###############################################################################################
### I)  "index" function that returns all employees assigned to the logged in manager.      ###
###############################################################################################
    public function index() {

        $usrID = Auth::user();
        $id=$usrID->id;

        ###dump($id);
        ###if($id) {Session::flash('message', $id[0]->name. ' logged on.');}

        $employees = Employee::where('team_id', '=', $id)->get();

    return view('login.index')->with(['employees' => $employees]); 
    }


###############################################################################################
### II)  "tologin" function that returns all employees assigned to the logged in manager.   ###
###############################################################################################
    public function tologin() {

        return redirect('/login');
    }     

    //
###    public function access() {
###
###        $employees = Employee::all(); 
###        return view('login.mgrportal')->with(['employees' => $employees]); 
###    }
    
    //
###    public function mgrportal() {
###
###        $employees = Employee::all();
###        dump($employees);
###        return view('login.mgrportal')->with(['employees' => $employees]); 
###    }

   /**
    * GET
    * /employee/{id}
    */
###############################################################################################
### III)  "show" function that returns data for a particular employee.                      ###
###############################################################################################
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
##################################################################################################
### IV) "createNewEmployee" function that returns categories to be assigned a to new employee. ###
##################################################################################################
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
#######################################################################################################################################
### V) "saveNewEmployee" function saves a new employee with unchecked categories. new employee is assigned the logged in manager.   ###
#######################################################################################################################################
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

        ###########################################################################################################################################
        # Add new employee to database first                                                                                                      #
        ###########################################################################################################################################
        $employee = new Employee();
        $employee->title = $request->title;
        $employee->first_name = $request->firstName;
        $employee->last_name = $request->lastName;
        $employee->team_id = $id;
        $employee->save();
 
        ###########################################################################################################################################
        # assigns categories to the $tag array only if there are categories in the request collection. Otherwise an empty array is assigned.      #   
        # then categories are assigned to the employee named as tags, synched via the previously established relationship between the Category    # 
        # and Employee Models.                                                                                                                    #
        ###########################################################################################################################################
        $tags = ($request->tags) ? : [];
        $employee->categories()->sync($tags);
        $employee->save();

        Session::flash('message','Employee '.$employee->first_name.' '.$employee->last_name.' was added to team '.$manager[0]->first_name.' '.$manager[0]->last_name.'. ');

        return redirect('/');
    }

/**
* POST
* /employees/edit
* Process form to edit a employee
*/
#######################################################################################################################################
### VI) "edit" function allows editing of the selected employees category assignments.
#######################################################################################################################################
public function edit(Request $request) {

    $id=$request->id;
    if($request->id==0) {
        Session::flash('message', 'The selected employee is not valid.');
        return redirect('/index');
    }


    $edit_delete=$request->edit_delete;
    if($request->edit_delete=='show') {
        Session::flash('message', 'Employee found.');
        return redirect('/show/'.$request->id);
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
#######################################################################################################################################
### VII) "saveEdits" function allows edited category assignments to be saved to the edited employee.                                  #
#######################################################################################################################################
public function saveEdits(Request $request) {

        $employee = Employee::find($request->id);

        ###if($request->tags) {$tags = $request->tags;}

       ###else {   $tags = [];
       ### }

        ###########################################################################################################################################
        # assigns categories to the $tag array only if there are categories in the request collection. Otherwise an empty array is assigned.      #   
        # then categories are assigned to the employee named as tags, synched via the previously established relationship between the Category    # 
        # and Employee Models.                                                                                                                    #
        ###########################################################################################################################################
        $tags = ($request->tags)?: [];
        $employee->categories()->sync($tags);
        $employee->save();

        Session::flash('message', 'Your changes to '.$employee->first_name. ' '.$employee->last_name. ' were saved.');

        return redirect('/security/'.$request->id);

    }

    /**
    * GET
    * Page to confirm deletion
    */
#######################################################################################################################################
### VIII) "confirmDeletion" function hard deletes the targeted employee and passes the logic flow to the delete view.                 #
#######################################################################################################################################
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
#######################################################################################################################################
### IX) "delete" function identifies targeted employee and passes the logic flow to the delete view.                                  #
#######################################################################################################################################
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


