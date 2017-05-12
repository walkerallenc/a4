<?php
################################################################
#CSCI E-15 Dynamic Web Applications                            #
#Assignment A4                                                 #
#Developer: Allen C. Walker                                    #
################################################################

namespace App;

use Illuminate\Database\Eloquent\Model;

###########################################################################
### This Model class contains the logic regarding the managers table.   ###
### I)  Sets up a relationships with the Employee Model.                ###
### II) Contains a function that returns data from the managers table   ###
###     that is used in a future manager dropdown list.                 ###
###########################################################################
class Manager extends Model
{
    public function employees() {
             # Manager has many Employees 
             # Define a one-to-many relationship. 
             return $this->hasMany('App\Employee'); 
    } 

    public static function getManagersForDropdown() {

        # Get all the managers
        $managers = Manager::orderBy('last_name', 'ASC')->get();

        # Organize the managers into an array where the key = team id and value = manager name
        $managersForDropdown = [];
        foreach($managers as $manager) {
            $managersForDropdown[$manager->id] = $manager->id.', '.$manager->last_name.', '.$manager->first_name;
        }
        return $managersForDropdown;

    }
}


