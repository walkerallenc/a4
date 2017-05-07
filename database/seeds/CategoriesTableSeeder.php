<?php

use Illuminate\Database\Seeder;
use App\Category;


class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
public function run() { 
    $categories = ['ring', 'earring', 'bracelet', 'necklace', 'pendant'];     
    foreach($categories as $categoryName) { 
        $category = new Category(); 
        $category->name = $categoryName; 
        $category->save(); 
        } 
    }
}
