<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductSeeder extends Seeder
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
        DB::table('product')->insert([
        	'product_name' => 'Laundry Kiloan (Cuci)',
        	'product_price' => 5000,
            'created_at' => $createdDate,
            'updated_at' => $createdDate,
        ]);
        DB::table('product')->insert([
        	'product_name' => 'Laundry Kiloan (Gosok)',
        	'product_price' => 9000,
            'created_at' => $createdDate,
            'updated_at' => $createdDate,
        ]);
        DB::table('product')->insert([
        	'product_name' => 'Laundry Premium (Pcs)',
        	'product_price' => 15000,
            'created_at' => $createdDate,
            'updated_at' => $createdDate,
        ]);
    }
}
