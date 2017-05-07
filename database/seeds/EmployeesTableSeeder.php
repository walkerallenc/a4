<?php

use Illuminate\Database\Seeder;
use App\Employee;


class EmployeesTableSeeder extends Seeder
{
    public function run()
    {

        # Load json file into PHP array
        # Array of author data to add 
        $employees = 
        [ 
            ['John','Anderson','salesperson'], 
            ['Nick','Williams','salesperson'], 
            ['Patricia','Reilly','salesperson'], 
            ['David','Chow','salesperson'], 
            ['Gordon','Ramsey','salesperson'], 
            ['Edward','Hernandez','salesperson'], 
        ]; 
    ###

    $timestamp = Carbon\Carbon::now()->subDays(count($employees));

    foreach($employees as $employee) {

        Employee::insert([
            'created_at' => $timestamp,
            'updated_at' => $timestamp,
            'first_name' => $employee[0],
            'last_name' => $employee[1],
            'title' => $employee[2],
            'team_id' => 1,
            ]);
        }
    }
}
