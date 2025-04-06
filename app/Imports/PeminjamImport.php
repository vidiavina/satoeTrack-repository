<?php

namespace App\Imports;

use App\Models\TemporaryPeminjam;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;

class PeminjamImport implements ToCollection
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // skip header
            if (isset($row[0]) && $row[0] === 'Nama') {
                continue;
            }

            // cek apakah kolom yang dibutuhkan ada
            if (!$row->has([0, 1, 2, 3, 4])) {
                // Log::warning('Baris tidak lengkap, kolom yang dibutuhkan tidak ada', [
                //     'row' => $row,
                // ]);
                continue;
            }


            $nis = $row[1] ?? null;
            $nip = $row[2] ?? null; // hanya jika kolom ke-5 tersedia
            $email = $row[3];

            // Log::info('terbaca excel:', [
            //     'nama' => $row[0],
            //     'nis' => $nis,
            //     'nip' => $nip,
            //     'email' => $email,
            //     'no_telp' => $row[4] ?? null,
            // ]);

            // pakai email sebagai key unik (bisa juga nis atau nip)
            TemporaryPeminjam::updateOrCreate(
                [
                    'nis' => $nis,
                    'nip' => $nip,
                    'email' => $email,
                ],
                [
                    'nama' => $row[0],
                    'nis' => $nis ?: null,
                    'nip' => $nip ?: null,
                    'email' => $email,
                    'no_telp' => $row[4] ?? null,
                    'password' => $nis ?? $nip,
                    'kode_import' => $this->data['kode_import'],
                ]
            );
        }
    }
}
