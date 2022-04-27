<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now()->modify('-2 year');
        $createdDate = clone($date);
        DB::table('category')->insert([
        	'category_name' => 'Baju',
        	'category_status' => 0,
            'created_at' => $createdDate,
            'updated_at' => $createdDate,
        ]);
        DB::table('category')->insert([
        	'category_name' => 'Kemeja',
        	'category_status' => 1,
            'created_at' => $createdDate,
            'updated_at' => $createdDate,
        ]);
    }
}
