<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pecahan;
class PecahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pecahan::create(['group'=>1,'satuan'=>1000,'jml'=>3,'void'=>0]);
        Pecahan::create(['group'=>1,'satuan'=>2000,'jml'=>3,'void'=>1]);
        Pecahan::create(['group'=>1,'satuan'=>5000,'jml'=>3,'void'=>1]);
        Pecahan::create(['group'=>10,'satuan'=>10000,'jml'=>3,'void'=>1]);
        Pecahan::create(['group'=>10,'satuan'=>20000,'jml'=>3,'void'=>1]);
        Pecahan::create(['group'=>10,'satuan'=>50000,'jml'=>3,'void'=>1]);
        Pecahan::create(['group'=>100,'satuan'=>100000,'jml'=>3,'void'=>0]);
    }
}
