<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class Dataawal extends Seeder
{
    /**
     * Run the database seeds.
     */
        //
        public function run(): void
        {
            $user = new User();
            $user->name = 'Admin';
            $user->email = 'admin@kasir.com';
            $user->password = bcrypt('password');
            $user->peran = 'admin';
            $user->save();

            $user = new User();
            $user->name = 'Fikron   ';
            $user->email = 'fikron@cust.com';
            $user->password = bcrypt('password');
            $user->peran = 'customer';
            $user->save();
        }
}
