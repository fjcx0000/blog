<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'email' => 'admin@heqs.com.au',
            'name' => 'James.Yang',
            'password' => Hash::make('123456'),
            'nickname' => 'admin',
            'is_admin' => 1,
            ]);
    }
}
