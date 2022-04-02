<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JasaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jasa')->insert([
        	'nama_jasa' => 'Laundry Kiloan (Cuci)',
        	'biaya_jasa' => 5000,
        ]);
        DB::table('jasa')->insert([
        	'nama_jasa' => 'Laundry Kiloan (Gosok)',
        	'biaya_jasa' => 9000,
        ]);
        DB::table('jasa')->insert([
        	'nama_jasa' => 'Laundry Premium (Pcs)',
        	'biaya_jasa' => 15000,
        ]);
    }
}
