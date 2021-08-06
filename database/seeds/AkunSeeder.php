<?php

use Illuminate\Database\Seeder;
use App\Models\Akun;
class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Akun::create([
            'jenis_akun' => 'in',
            'nama_akun' => 'Infaq Tetap Bulanan',
        ]);

        Akun::create([
            'jenis_akun' => 'out',
            'nama_akun' => 'KOREKSI: Infaq Tetap Bulanan',
        ]);

        Akun::create([
            'jenis_akun' => 'in',
            'nama_akun' => 'Infaq Sholat Jum\'at',
        ]);

        Akun::create([
            'jenis_akun' => 'out',
            'nama_akun' => 'KOREKSI: Infaq Sholat Jum\'at',
        ]);

        Akun::create([
            'jenis_akun' => 'out',
            'nama_akun' => 'Kajian Tahsin Al Quran',
        ]);

        Akun::create([
            'jenis_akun' => 'in',
            'nama_akun' => 'KOREKSI: Kajian Tahsin Al Quran',
        ]);

        Akun::create([
            'jenis_akun' => 'out',
            'nama_akun' => 'Khotib & Imam Sholat Jum\'at',
        ]);

        Akun::create([
            'jenis_akun' => 'in',
            'nama_akun' => 'KOREKSI: Khotib & Imam Sholat Jum\'at',
        ]);

        Akun::create([
            'jenis_akun' => 'out',
            'nama_akun' => 'Infaq Program Anak Asuh Ad-Dawa',
        ]);

        Akun::create([
            'jenis_akun' => 'in',
            'nama_akun' => 'KOREKSI: Infaq Program Anak Asuh Ad-Dawa',
        ]);

        Akun::create([
            'jenis_akun' => 'out',
            'nama_akun' => 'Infaq Ponpes Anak Yatim Al Matsuroh',
        ]);

        Akun::create([
            'jenis_akun' => 'in',
            'nama_akun' => 'KOREKSI: Infaq Ponpes Anak Yatim Al Matsuroh',
        ]);

        Akun::create([
            'jenis_akun' => 'in',
            'nama_akun' => 'SALDO AWAL by Admin',
        ]);

        Akun::create([
            'jenis_akun' => 'in',
            'nama_akun' => 'Stock Opname GAIN (IN)',
        ]);

        Akun::create([
            'jenis_akun' => 'out',
            'nama_akun' => 'Stock Opname LOSS (OUT)',
        ]);


    }
}
