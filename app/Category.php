<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Employee;

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
