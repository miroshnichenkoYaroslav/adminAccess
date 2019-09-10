<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['guard_name' => 'web', 'name' => 'view all']);
        Permission::create(['guard_name' => 'web', 'name' => 'view AdminCabinetController']);
        Permission::create(['guard_name' => 'web', 'name' => 'view PageController']);
    }
}
