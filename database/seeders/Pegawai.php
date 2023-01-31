<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Pegawai;

class PegawaiSeeder extends Seeder
{
   
    public function run()
    {

        Pegawai::factory(10)->create();

    }
}
