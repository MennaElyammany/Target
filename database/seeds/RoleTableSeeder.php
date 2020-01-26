<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_Admin = Role::create(['name'=>'Admin']);
        $role_Influencer = Role::create(['name'=>'Influencer']);
        $role_Client= Role::create(['name'=>'Client']);

    }
}
