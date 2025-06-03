<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Camp;
use App\Models\Kamar;
use App\Models\BookingCalendar;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create 15 Camps
        $camps = [];
        for ($i = 1; $i <= 15; $i++) {
            $camps[] = [
                'nama_camp' => 'Camp ' . chr(64 + $i), // Camp A, B, C, ... O
                'deskripsi' => 'Camp dengan fasilitas lengkap untuk semua kategori - Unit ' . $i,
                'gambar_camp' => 'camp-' . strtolower(chr(64 + $i)) . '.jpg',
                'alamat' => 'Jl. Brilliant No. ' . $i . ', Jakarta',
                'jumlah_maksimal_kamar' => 250, // 25 per type per gender = 250 total
            ];
        }

        foreach ($camps as $campData) {
            $camp = Camp::create($campData);
            $this->createRoomsForCamp($camp);
        }
    }

    private function createRoomsForCamp($camp)
    {
        // 5 tipe kamar sesuai permintaan (ini akan masuk ke kolom type_kamar)
        $roomTypes = [
            ['type' => 'regular', 'beds' => 2, 'price' => 100000],
            ['type' => 'regular+', 'beds' => 3, 'price' => 150000],
            ['type' => 'homestay', 'beds' => 2, 'price' => 120000],
            ['type' => 'homestay+', 'beds' => 4, 'price' => 200000],
            ['type' => 'vip', 'beds' => 4, 'price' => 350000],
        ];

        // Kategori tetap "brilliant" untuk semua kamar
        $kategori = 'brilliant';

        $genders = ['Laki-laki', 'Perempuan'];
        $roomCounter = 1;

        foreach ($roomTypes as $roomType) {
            foreach ($genders as $gender) {
                // Buat 25 kamar per tipe kamar per gender per camp
                for ($roomNum = 1; $roomNum <= 25; $roomNum++) {
                    $kamar = Kamar::create([
                        'camp_id' => $camp->id,
                        'nama_kamar' => $this->generateRoomName($roomType['type'], $gender, $roomNum),
                        'type_kamar' => $roomType['type'], // Sekarang ini benar: regular, regular+, homestay, homestay+, vip
                        'kategori' => $kategori, // Selalu "brilliant"
                        'gender' => $gender,
                        'jumlah_kasur' => $roomType['beds'],
                        'fasilitas' => $this->getFasilitasByType($roomType['type']),
                        'peraturan' => 'Dilarang merokok, Jam malam 22:00, Tamu tidak diperbolehkan menginap',
                        'gambar' => "room-{$roomCounter}.jpg",
                        'harga' => $roomType['price'],
                        'catatan_tambahan' => 'Kamar nyaman dengan fasilitas lengkap tipe ' . $roomType['type'],
                    ]);

                    // Buat booking scenario yang bervariasi untuk memastikan semua status muncul
                    $this->createBookingsForRoom($kamar, $roomCounter);
                    $roomCounter++;
                }
            }
        }
    }

    private function getFasilitasByType($type)
    {
        return match ($type) {
            'regular' => 'AC, WiFi, Kamar Mandi Bersama, Lemari, Meja Belajar',
            'regular+' => 'AC, WiFi, Kamar Mandi Bersama, Lemari, Meja Belajar, Air Panas',
            'homestay' => 'AC, WiFi, Kamar Mandi Dalam, Lemari, Meja Belajar',
            'homestay+' => 'AC, WiFi, Kamar Mandi Dalam, Lemari, Meja Belajar, TV LED',
            'vip' => 'AC, WiFi, Kamar Mandi Dalam, Lemari, Meja Belajar, TV LED, Kulkas Mini, Water Dispenser',
            default => 'AC, WiFi, Lemari, Meja Belajar'
        };
    }

    private function generateRoomName($type, $gender, $roomNum)
    {
        $typePrefix = match ($type) {
            'regular' => 'R',
            'regular+' => 'RP',
            'homestay' => 'H',
            'homestay+' => 'HP',
            'vip' => 'V',
            default => 'R'
        };

        $genderSuffix = $gender === 'Laki-laki' ? 'M' : 'F';

        return $typePrefix . $genderSuffix . str_pad($roomNum, 2, '0', STR_PAD_LEFT);
    }

    private function createBookingsForRoom($kamar, $roomNumber)
    {
        $today = Carbon::now('Asia/Jakarta');
        $names = [
            'Ahmad Susanto',
            'Budi Hartono',
            'Citra Dewi',
            'Dani Pratama',
            'Eka Sari',
            'Farid Rahman',
            'Gita Permata',
            'Hadi Nugroho',
            'Indri Lestari',
            'Joko Widodo',
            'Kartika Sari',
            'Lukman Hakim',
            'Maya Sari',
            'Nina Adriani',
            'Oscar Pratama',
            'Putri Indah',
            'Rina Sari',
            'Sari Dewi',
            'Tono Sugiarto',
            'Umar Bakri',
            'Vina Melati',
            'Wawan Setiawan',
            'Yuni Astuti',
            'Zainal Abidin'
        ];

        // Distribusi scenario untuk memastikan semua status muncul:
        // 0: Kosong (33% dari kamar) - booking masa lalu dan masa depan
        // 1: Terisi sebagian (33% dari kamar) - beberapa booking aktif
        // 2: Penuh (34% dari kamar) - booking aktif sampai penuh
        $scenario = $roomNumber % 3;

        // Untuk camp tertentu, tambahkan variasi lebih untuk memastikan distribusi merata
        $campVariation = ($kamar->camp_id - 1) % 3;
        $finalScenario = ($scenario + $campVariation) % 3;

        switch ($finalScenario) {
            case 0: // Kamar KOSONG (tidak ada booking aktif saat ini)
                // Tambahkan booking masa lalu (sudah selesai)
                BookingCalendar::create([
                    'kamar_id' => $kamar->id,
                    'nama' => $names[array_rand($names)],
                    'gender' => $kamar->gender,
                    'start_date' => $today->copy()->subDays(rand(30, 60)),
                    'end_date' => $today->copy()->subDays(rand(15, 29)),
                    'quantity' => 1,
                ]);
                break;

            case 1: // Kamar TERISI SEBAGIAN (beberapa kasur terisi)
                $totalBeds = $kamar->jumlah_kasur;
                $occupiedBeds = rand(1, max(1, $totalBeds - 1)); // Minimal 1, maksimal total-1

                // Buat booking aktif (sedang berlangsung)
                for ($i = 0; $i < $occupiedBeds; $i++) {
                    BookingCalendar::create([
                        'kamar_id' => $kamar->id,
                        'nama' => $names[array_rand($names)],
                        'gender' => $kamar->gender,
                        'start_date' => $today->copy()->subDays(rand(1, 5)),
                        'end_date' => $today->copy()->addDays(rand(5, 15)),
                        'quantity' => 1,
                    ]);
                }

                // Tambahkan booking masa lalu
                BookingCalendar::create([
                    'kamar_id' => $kamar->id,
                    'nama' => $names[array_rand($names)],
                    'gender' => $kamar->gender,
                    'start_date' => $today->copy()->subDays(rand(40, 60)),
                    'end_date' => $today->copy()->subDays(rand(25, 39)),
                    'quantity' => 1,
                ]);
                break;

            case 2: // Kamar PENUH (semua kasur terisi)
                // Buat booking aktif untuk semua kasur
                for ($i = 0; $i < $kamar->jumlah_kasur; $i++) {
                    BookingCalendar::create([
                        'kamar_id' => $kamar->id,
                        'nama' => $names[array_rand($names)],
                        'gender' => $kamar->gender,
                        'start_date' => $today->copy()->subDays(rand(1, 3)),
                        'end_date' => $today->copy()->addDays(rand(10, 20)),
                        'quantity' => 1,
                    ]);
                }

                // Tambahkan booking masa lalu
                for ($i = 0; $i < rand(2, 3); $i++) {
                    BookingCalendar::create([
                        'kamar_id' => $kamar->id,
                        'nama' => $names[array_rand($names)],
                        'gender' => $kamar->gender,
                        'start_date' => $today->copy()->subDays(rand(50, 80)),
                        'end_date' => $today->copy()->subDays(rand(30, 49)),
                        'quantity' => 1,
                    ]);
                }
                break;
        }

        // Tambahkan beberapa booking masa lalu untuk history (semua kamar)
        for ($i = 0; $i < rand(1, 3); $i++) {
            BookingCalendar::create([
                'kamar_id' => $kamar->id,
                'nama' => $names[array_rand($names)],
                'gender' => $kamar->gender,
                'start_date' => $today->copy()->subDays(rand(90, 120)),
                'end_date' => $today->copy()->subDays(rand(70, 89)),
                'quantity' => 1,
            ]);
        }
    }
}