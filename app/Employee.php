<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
###use App\Manager;

class Employee extends Model
{
    public function manager() { 
            # Employee belongs to Manager 
            # Define an inverse one-to-many relationship. 
            return $this->belongsTo('App\Manager'); 
        } 

    public function categories() {
            # With timetsamps() will ensure the pivot table has its created_at/updated_at fields automatically maintained
            return $this->belongsToMany('App\Category')->withTimestamps();
        }
}
