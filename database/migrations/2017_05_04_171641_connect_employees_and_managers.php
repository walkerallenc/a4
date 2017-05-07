<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConnectEmployeesAndManagers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
public function up() { 
Schema::table('employees', function (Blueprint $table) { 

# Remove the field associated with the old way we were storing authors 

# Can do this here, or update the original migration that creates the `employees` table # 
$table->dropColumn('team'); 

# Add a new INT field called `team_id` that has to be unsigned (i.e. positive) 
$table->integer('team_id')
      ->unsigned(); 

# This field `team_id` is a foreign key that connects to the `id` field in the `managers` table 
$table->foreign('team_id')
      ->references('id')
      ->on('managers'); 
   }); 
} 

    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    Schema::table('employees', function (Blueprint $table) {
        # ref: http://laravel.com/docs/migrations#dropping-indexes
        # combine tablename + fk field name + the word "foreign"
        $table->dropForeign('employees_team_id_foreign');

        $table->dropColumn('team_id');
    });
   }
}