<?php

use Illuminate\Database\Seeder;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insert([
            ['country_name' => 'Egypt'],
            ['country_name' => 'Bahrain'],
            ['country_name' => 'Iraq'],
            ['country_name' => 'Jordan'],
            ['country_name' => 'Kuwait'],
            ['country_name' => 'Lebanon'],
            ['country_name' => 'Oman'],
            ['country_name' => 'Qatar'],
            ['country_name' => 'Saudi Arabia'],
            ['country_name' => 'Syria'],
            ['country_name' => 'United Arab Emirates'],
            ['country_name' => 'Tunisia'],
            ['country_name' => 'Algeria'],
            ['country_name' => 'Morocco'],
           

   
        ]);
    }
    }

