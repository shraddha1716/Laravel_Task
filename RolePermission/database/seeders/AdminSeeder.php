<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::create([
            'name'          => 'Admin',
            'email'         => 'admin@demo.com',
            'password'      => bcrypt('123'),
            'created_at'    => date("Y-m-d H:i:s")
        ]);
        $user->assignRole('Admin');

        // $user = User::create([
        //     'name'          => 'User',
        //     'email'         => 'auser@demo.com',
        //     'password'      => bcrypt('123'),
        //     'created_at'    => date("Y-m-d H:i:s")
        // ]);
        // $user->assignRole('User');
    }
}
