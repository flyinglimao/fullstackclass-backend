<?php

use Illuminate\Database\Seeder;
use App\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate();
        Admin::create([
            'username' => 'testtest',
            'password' => bcrypt('testtest'),
            'permissions' => '{}',
            'display_name' => 'Test',
            'email' => 'test@te.st',
            'phone' => '0912345678',
        ]);
    }
}
