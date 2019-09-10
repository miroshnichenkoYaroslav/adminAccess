<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('secret123'),
            'role_id' => '2',
        ]);
        $admin->assignRole('admin');
        $admin->givePermissionTo('view AdminCabinetController');

        $superAdmin = User::create([
            'name' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('secret123'),
            'role_id' => '1',
        ]);
        $superAdmin->assignRole('superadmin');
    }
}
