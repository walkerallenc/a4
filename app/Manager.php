<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

        # Organize the managers into an array where the key = author id and value = manager name
        $managersForDropdown = [];
        foreach($managers as $manager) {
            $managersForDropdown[$manager->id] = $manager->id.', '.$manager->last_name.', '.$manager->first_name;
        }
        return $managersForDropdown;

    }
}


