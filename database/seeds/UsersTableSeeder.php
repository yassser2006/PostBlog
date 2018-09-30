<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\User::create([
            'name'=>'Yasser ibrahim',
            'email'=>'yasser_e2005@hotmail.com',
            'password'=>bcrypt('123456')
        ]);
    }
}
