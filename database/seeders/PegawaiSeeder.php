<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use Illuminate\Database\Seeder;

class PegawaiSeeder extends Seeder
{
    public function run()
    {
        // Buat beberapa data pegawai untuk testing
        $pegawaiData = [
            [
                'nama' => 'Ahmad Subekti',
                'alamat' => 'Jl. Merdeka No. 123, Jakarta Pusat',
                'gender' => 'Laki-laki'
            ],
            [
                'nama' => 'Siti Nurhaliza',
                'alamat' => 'Jl. Sudirman No. 456, Jakarta Selatan',
                'gender' => 'Perempuan'
            ],
            [
                'nama' => 'Budi Santoso',
                'alamat' => 'Jl. Thamrin No. 789, Jakarta Pusat',
                'gender' => 'Laki-laki'
            ],
            [
                'nama' => 'Dewi Sartika',
                'alamat' => 'Jl. Gatot Subroto No. 321, Jakarta Selatan',
                'gender' => 'Perempuan'
            ],
            [
                'nama' => 'Riko Pratama',
                'alamat' => 'Jl. Kuningan No. 654, Jakarta Selatan',
                'gender' => 'Laki-laki'
            ]
        ];

        foreach ($pegawaiData as $data) {
            Pegawai::create($data);
        }
    }
}
