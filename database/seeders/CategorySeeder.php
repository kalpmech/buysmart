<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $categories = ['Coats','Jackets','Dresses','Shirts','T-shirts','Jeans'];
        $i = [1=>1,2=>2,3=>3];
        foreach ($categories as $value) {
            Category::Create(['name' => $value,'gender'=>array_rand($i)]);
        }
    }
}
