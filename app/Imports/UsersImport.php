<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow; // Import this


class UsersImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        \Log::info('Row data:', $row);

        $divisi = [
            'Admin' => 1,
            'IT' => 2,
            'HRD' => 3,
            'Keuangan' => 4,
            'Operasional' => 5,
            'Produksi' => 6,
            'Quality Control' => 7,
            'R&D' => 8,
            'Logistik' => 9,
            'Pemasaran' => 10,
        ];
        return new User([
            'name' => $row['nama'],
            'nip' => $row['nip'],
            'divisi_id' => $divisi[$row['divisi']],
            'password' => bcrypt($row['nama']),
        ]);
    }
}
