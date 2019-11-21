<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'sunwarul.dev@gmail.com')->first();
        if (!$user) {
            User::create([
                'name' => 'Sunwarul Islam',
                'email' => 'sunwarul.dev@gmail.com',
                'role' => 'admin',
                'password' => bcrypt('password'),
                'about' => 'About Sunwarul Islam',
            ]);
        }
    }
}
