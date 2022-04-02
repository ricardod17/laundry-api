<?php

namespace Database\Seeders;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
 
    	for($i = 1; $i <= 50; $i++){
 
    		DB::table('users')->insert([
    			'name' => $faker->name,
    			'email' => $faker->email,
    			'password' =>  Hash::make($faker->password),
    			'user_role' => 'member',
    		]);
 
    	}
    }
}
