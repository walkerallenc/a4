<?php

use Illuminate\Database\Seeder;
use App\Manager;

class ManagersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        # Load json file into PHP array
        # Array of author data to add 
        $managers = 
        [ 
            ['Enzo', 'Russo','manager'], 
            ['Karl', 'Shaeffer','manager'] 
        ]; 

    $timestamp = Carbon\Carbon::now()->subDays(count($managers));

    foreach($managers as $manager) {

        Manager::insert([
            'created_at' => $timestamp,
            'updated_at' => $timestamp,
            'first_name' => $manager[0],
            'last_name' => $manager[1],
            'title' => $manager[2],
            ]);
        }
    }
}
