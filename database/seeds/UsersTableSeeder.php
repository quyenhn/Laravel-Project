<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('users')->truncate();
    	App\User::create([
    		'name' => 'admin',
    		'email' =>'admin@gmail.com',
    		'password' => bcrypt('12345678')
    	]);
    }
}
