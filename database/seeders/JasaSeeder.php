<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JasaSeeder extends Seeder
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
        DB::table('jasa')->insert([
        	'nama_jasa' => 'Laundry Kiloan (Cuci)',
        	'biaya_jasa' => 5000,
            'created_at' => $createdDate,
            'updated_at' => $createdDate,
        ]);
        DB::table('jasa')->insert([
        	'nama_jasa' => 'Laundry Kiloan (Gosok)',
        	'biaya_jasa' => 9000,
            'created_at' => $createdDate,
            'updated_at' => $createdDate,
        ]);
        DB::table('jasa')->insert([
        	'nama_jasa' => 'Laundry Premium (Pcs)',
        	'biaya_jasa' => 15000,
            'created_at' => $createdDate,
            'updated_at' => $createdDate,
        ]);
    }
}
