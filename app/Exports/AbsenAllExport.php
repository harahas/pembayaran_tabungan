<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AbsenAllExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }

    public function headings(): array
    {
        // Tentukan judul kolom di sini, termasuk header khusus
        return [
            'No',
            'Nama',
            'Kelas',
            'Hadir',
            'Sakit',
            'Izin',
            'Alfa',
        ];
    }

    public function map($row): array
    {
        // Menggunakan nomor yang dihitung sebagai kolom pertama
        static $counter = 0;
        $counter++;

        // Sesuaikan kolom yang ingin diekspor di sini
        return [
            $counter,
            $row->nama,
            $row->kelas,
            $row->hadir,
            $row->sakit,
            $row->izin,
            $row->alfa,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Menambahkan border ke semua sel
        $cellRange = 'A1:F' . ($sheet->getHighestRow());
        $sheet->getStyle($cellRange)->getBorders()->getAllBorders()->setBorderStyle('thin');
    }
}
