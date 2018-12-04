<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'z',
            'email' => 'z@z.z',
            'password' => Hash::make('zzzzzz'),
            'isAdmin' => 1
        ]);
    }
}
