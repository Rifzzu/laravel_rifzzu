<?php

namespace Database\Seeders;

use App\Models\Hospital;
use Illuminate\Database\Seeder;

class HospitalSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['nama_rumah_sakit' => 'RS Umum Sejahtera', 'alamat' => 'Jl. Merdeka 1', 'email' => 'info@rssejahtera.id', 'telepon' => '021-111111'],
            ['nama_rumah_sakit' => 'RS Harapan Ibu', 'alamat' => 'Jl. Melati 2', 'email' => 'kontak@harapanibu.id', 'telepon' => '021-222222'],
            ['nama_rumah_sakit' => 'RS Prima Medika', 'alamat' => 'Jl. Anggrek 3', 'email' => 'hello@primamedika.id', 'telepon' => '021-333333'],
        ];

        foreach ($items as $item) {
            Hospital::query()->updateOrCreate(
                ['nama_rumah_sakit' => $item['nama_rumah_sakit']],
                $item
            );
        }
    }
}