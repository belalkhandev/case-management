<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $perm = new Permission();
        $perm->name = 'create_case';
        $perm->description = 'Can case create';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'update_case';
        $perm->description = 'Can case update';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'view_case';
        $perm->description = 'Can case view';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'delete_case';
        $perm->description = 'Can case delete';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'create_client';
        $perm->description = 'Can client create';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'update_client';
        $perm->description = 'Can client update';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'view_client';
        $perm->description = 'Can client view';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'delete_client';
        $perm->description = 'Can client delete';
        $perm->save();;
    }
}
