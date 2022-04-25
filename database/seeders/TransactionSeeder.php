<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class TransactionSeeder extends Seeder
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
        DB::table('transaction')->insert([
        	'customerid' => 2,
        	'productid' => 2,
        	'total_item' => 2,
        	'price' => 10000,
        	'status_transaction' => 0,
            'created_at' => $createdDate,
            'updated_at' => $createdDate,
        ]);
        DB::table('transaction')->insert([
        	'customerid' => 1,
        	'productid' => 4,
        	'total_item' => 1,
        	'price' => 25000,
            'status_transaction' => 1,
            'created_at' => $createdDate,
            'updated_at' => $createdDate,
        ]);
    }
}
