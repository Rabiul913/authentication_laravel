<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
               'name'=>'Admin',
               'email'=>'admin@rabiul.com',
                'is_admin'=>'1',
               'password'=> Hash::make('123456'),
            ],
            [
               'name'=>'User',
               'email'=>'user@rabiul.com',
                'is_admin'=>'0',
               'password'=> Hash::make('123456'),
            ],
        ];
  
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
