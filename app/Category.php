<?php
################################################################
#CSCI E-15 Dynamic Web Applications                            #
#Assignment A4                                                 #
#Developer: Allen C. Walker                                    #
################################################################

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Employee;

###########################################################################
### This Model class contains the logic regarding the categories table. ###
### I)  Sets up a relationships with the Employee Model.                ###
### II) Contains a function that returns data from the categories       ###
###     that is used in checkboxes for each employee.                   ###
###########################################################################
class Category extends Model
{

        public function employees() {
            return $this->belongsToMany('App\Employee')->withTimestamps();
        }

        public static function getCategoriesForCheckboxes() {

        $categories = Category::orderBy('name','ASC')->get();

        $categoriesForCheckboxes = [];

        foreach($categories as $category) {
            $categoriesForCheckboxes[$category['id']] =   
            $category->name;
        }
    return $categoriesForCheckboxes;
    }
}
