<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Makanan;
class MakananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Makanan::create([
            'nama'=>'biskuit',
            'jenis'=>'biskuit',
            'harga'=>'6000',
            'stock'=>20
        ]);
        Makanan::create([
            'nama'=>'chips',
            'jenis'=>'snak',
            'harga'=>'8000',
            'stock'=>5
        ]);
        Makanan::create([
            'nama'=>'oreo',
            'jenis'=>'coockies',
            'harga'=>'10000',
            'stock'=>11
        ]);
        Makanan::create([
            'nama'=>'tango',
            'jenis'=>'wafer',
            'harga'=>'12000',
            'stock'=>7
        ]);
        Makanan::create([
            'nama'=>'coklat',
            'jenis'=>'coklat',
            'harga'=>'15000',
            'stock'=>30
        ]);
    }
}
