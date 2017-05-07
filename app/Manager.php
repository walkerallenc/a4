<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    public function employees() {
             # Manager has many Employees 
             # Define a one-to-many relationship. 
             return $this->hasMany('App\Employee'); } 

}


