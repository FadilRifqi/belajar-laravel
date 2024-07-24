<?php

namespace Database\Seeders;

use App\Models\Divisi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divisi = [
            ['nama' => 'Admin', 'kode' => '1110', 'ruangan' => 'Ruang 0'],
            ['nama' => 'IT', 'kode' => '1111', 'ruangan' => 'Ruang 1'],
            ['nama' => 'HRD', 'kode' => '1112', 'ruangan' => 'Ruang 2'],
            ['nama' => 'Keuangan', 'kode' => '1113', 'ruangan' => 'Ruang 3'],
            ['nama' => 'Operasional', 'kode' => '1115', 'ruangan' => 'Ruang 5'],
            ['nama' => 'Produksi', 'kode' => '1116', 'ruangan' => 'Ruang 6'],
            ['nama' => 'Quality Control', 'kode' => '1117', 'ruangan' => 'Ruang 7'],
            ['nama' => 'R&D', 'kode' => '1118', 'ruangan' => 'Ruang 8'],
            ['nama' => 'Logistik', 'kode' => '1119', 'ruangan' => 'Ruang 9'],
            ['nama' => 'Pemasaran', 'kode' => '1120', 'ruangan' => 'Ruang 10'],
        ];
        Divisi::query()->insert($divisi);
    }
}
