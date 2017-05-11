<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // $this->call(UsersTableSeeder::class);
              # Because `books` will be associated with `authors`, 
              # authors should be seeded first 
           ###   $this->call(AuthorsTableSeeder::class); 
           ###   $this->call(BooksTableSeeder::class); 
           ###   $this->call(TagsTableSeeder::class);
           ###   $this->call(BookTagTableSeeder::class);
###              $this->call(ManagersTableSeeder::class); 
###              $this->call(EmployeesTableSeeder::class); 
###              $this->call(CategoriesTableSeeder::class); 
###              $this->call(EmployeeCategoryTableSeeder::class); 
              $this->call(UsersTableSeeder::class); 
    }
}
