<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;
class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mahasiswa::create([
            'nim' => '2023001',
            'nama' => 'Budi Santoso',
            'jurusan' => 'Teknik Informatika'
        ]);


        Mahasiswa::create([
            'nim' => '2023002',
            'nama' => 'Siti Aminah',
            'jurusan' => 'Sistem Informasi'
        ]);

    }
}
