<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class UsersExport implements FromCollection, WithHeadings, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::with([
            'presensi' => function ($query) {
                $query->where('tanggal_presensi', now()->toDateString());
            }
        ])
            ->where('role_id', 2)
            ->get()
            ->sortBy('divisi_id') // Sort by 'Divisi' first
            ->values() // Reset keys to ensure they start from 0
            ->map(function ($user, $index) {
                // Apply numbering after sorting
                $user->makeHidden(['role_id', 'id', 'nip']);
                $user->setAttribute('No', $index + 1); // Numbering is now sequential within each 'Divisi'
                $user->presence_status = ($user->presensi->first() && $user->presensi->first()->presensi) == true ? 'Hadir' : 'Tidak Hadir';
                $user->setAttribute('Nama', $user->name);
                $user->setAttribute('Divisi', $user->divisi->nama);
                $user->setAttribute('Keterangan', $user->presence_status);
                $user->makeHidden(['name', 'divisi_id', 'presence_status']);
                return $user;
            });
    }

    public function headings(): array
    {
        return ['No', 'Nama', 'Divisi', 'Keterangan'];
    }

    /**
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        $headerStyleArray = [
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'color' => ['argb' => 'FF00FFFF'], // Blue color
            ],
        ];
        $styleArray = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ];

        $sheet->getStyle('A1:D1')->applyFromArray($headerStyleArray);
        // Assuming your data will not exceed 1000 rows and you have 4 columns (A to D)
        $sheet->getStyle('A1:D1000')->applyFromArray($styleArray);

        $sheet->getColumnDimension('B')->setWidth(31.33); // Approx 235 px
        $sheet->getColumnDimension('C')->setWidth(18);    // Approx 135 px
        $sheet->getColumnDimension('D')->setWidth(20.67);

        return [];
    }
}
