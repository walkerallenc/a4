<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Category;
use App\Employee;

class CreateCategoryEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
public function up() { 
    Schema::create('category_employee', function (Blueprint $table) { 
    $table->increments('id'); 
    $table->timestamps(); 
    # `category_id` and `employee_id` will be foreign keys, so they have to be unsigned 
    # Note how the field names here correspond to the tables they will connect... 
    # `category_id` will reference the `categories table` and `employee_id` will reference 
    #the `employees` table.   
    $table->integer('category_id')->unsigned(); 
    $table->integer('employee_id')->unsigned(); 
    # Make foreign keys 
    $table->foreign('category_id')->references('id')->on('categories'); 
    $table->foreign('employee_id')->references('id')->on('employees'); 
    }); 
} 


/**
* Reverse the migrations.
*
* @return void
*/
public function down() {
         Schema::drop('category_employee'); 
    }
}
