<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['category_name'=>'Beauty'],
            ['category_name'=>'Food'],
            ['category_name'=>'Vlogs'],
            ['category_name'=>'Gaming'],
            ['category_name'=>'Entertainment'],
            ['category_name'=>'Science'],
            ['category_name'=>'Music'],


        ]);
    }
}
