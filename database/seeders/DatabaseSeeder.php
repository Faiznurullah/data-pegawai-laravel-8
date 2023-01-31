<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->insert([
        //     [
        //        'name'=>'Kobawon',
        //        'email'=>'admin@example.com',
        //        'password'=> bcrypt('123456'),
        //     ],
        //     [
        //        'name'=>'Brian',
        //        'email'=>'user@example.com',
        //        'password'=> bcrypt('123456'),
        //     ]
        // ]);

        // Pegawai::factory(10)->create();

        // User::factory(10)->create();
        
    }

}
