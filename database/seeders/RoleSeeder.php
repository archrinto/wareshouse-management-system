<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('model_has_roles')->truncate();
        DB::table('roles')->truncate();

        $roles = [
            ['name' => 'Super Admin'],
            ['name' => 'Warehouse Admin']
        ];

        foreach ($roles as $role) {
            $rele = Role::create($role);
        }
    }
}
