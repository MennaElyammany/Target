<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([

             'name'=>'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123456'),
            'role'=>'Admin',
            'country_id'=>1

        ]);
        $user->assignRole('Admin');
    }
        
    }

