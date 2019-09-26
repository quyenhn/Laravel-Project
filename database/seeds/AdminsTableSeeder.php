<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	App\Admin::create([
    		'name' => 'admin',
    		'email' =>'admin@gmail.com',
    		'password' => bcrypt('12345678')
    	]);
    }
}
