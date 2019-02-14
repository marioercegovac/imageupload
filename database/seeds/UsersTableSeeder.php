<?php

use Illuminate\Database\Seeder;
use \App\Http\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Mario',
            'username' => 'developer',
            'password' => bcrypt('devtest'),
            'email' => 'mario.ercegovac@typeqast.com',
        ]);
    }
}

