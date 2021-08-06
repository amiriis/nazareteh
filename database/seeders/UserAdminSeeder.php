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

        $user = new User;
        $user->name = 'رئیس کل';
        $user->email = 'ceo@nazareteh.ir';
        $user->password = Hash::make('amir1374720');
        $user->save();

        $user->assignRole('Super Admin');
    }
}
