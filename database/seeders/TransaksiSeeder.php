<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transaksi')->insert([
        	'customerid' => 2,
        	'jasaid' => 2,
        	'jlh_item' => 2,
        	'biaya' => 10000,
        	'status_transaksi' => 0,
        ]);
        DB::table('transaksi')->insert([
        	'customerid' => 1,
        	'jasaid' => 4,
        	'jlh_item' => 1,
        	'biaya' => 25000,
            'status_transaksi' => 1,
        ]);
    }
}
