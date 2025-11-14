<?php

namespace Database\Seeders;

use App\Models\Hospital;
use App\Models\Patient;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    public function run(): void
    {
        $hospitals = Hospital::all();
        if ($hospitals->isEmpty()) {
            return;
        }

        $data = [
            ['nama_pasien' => 'Budi', 'alamat' => 'Jl. Mangga 10', 'no_telepon' => '081234567890'],
            ['nama_pasien' => 'Siti', 'alamat' => 'Jl. Jeruk 11', 'no_telepon' => '081234567891'],
            ['nama_pasien' => 'Andi', 'alamat' => 'Jl. Apel 12', 'no_telepon' => '081234567892'],
            ['nama_pasien' => 'Rina', 'alamat' => 'Jl. Pisang 13', 'no_telepon' => '081234567893'],
        ];

        foreach ($data as $i => $item) {
            $hospital = $hospitals[$i % $hospitals->count()];
            Patient::query()->create(array_merge($item, ['hospital_id' => $hospital->id]));
        }
    }
}