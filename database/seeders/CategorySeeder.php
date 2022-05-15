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
        $categories = ['male','female','child'];
        // echo "<pre/>";
        // print_r($categories);
        // die("EX");
        foreach ($categories as $value) {
            Category::Create(['name' => $value]);
        }
    }
}