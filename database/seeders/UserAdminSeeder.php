<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'Super Admin']);
        Role::create(['name' => 'Expert']);
        Role::create(['name' => 'Member']);

        $admin = new User;
        $admin->name = 'رئیس کل';
        $admin->email = 'ceo@nazareteh.ir';
        $admin->password = Hash::make('amir1374720');
        $admin->save();

        $admin->assignRole('Super Admin');

        $user = new User;
        $user->name = 'امیرحسین محمودی';
        $user->email = 'test@test.com';
        $user->password = Hash::make('123456789');
        $user->save();

        $user->assignRole('Member');
    }
}
