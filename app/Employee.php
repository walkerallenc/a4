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
### I)  Sets up a relationships with the Manager Model.                 ###
### II) Sets up a relationships with the Category Model.                ###
###########################################################################
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
