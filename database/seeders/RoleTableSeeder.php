<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions_lawyer = Permission::all();
        $permissions_assistant  = Permission::whereNotIn('name', [
            'delete_case', 'delete_client'
        ])->get();

        $role = new Role();
        $role->name = 'lawyer';
        $role->description = 'User role for lawyer';
        $role->save();
        $role->attachPermissions($permissions_lawyer);

        $role = new Role();
        $role->name = 'assistant';
        $role->description = 'Lawyer assistant';
        $role->save();
        $role->attachPermissions($permissions_assistant);
    }
}
