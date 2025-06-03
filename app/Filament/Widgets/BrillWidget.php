<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Camp;
use App\Models\Kamar;
use App\Models\BookingCalendar;
use Carbon\Carbon;

class BrillWidget extends Widget
{
    protected static string $view = 'filament.widgets.brill-widget';
    protected static ?int $sort = 2;
    protected int|string|array $columnSpan = 'full';

    public $search = '';

    public function updatedSearch()
    {
        // This will automatically refresh the widget when search changes
    }

    public function getRoomsByCategory(): array
    {
        $categories = ['regular', 'regular+', 'homestay', 'homestay+', 'vip'];
        $roomData = [];

        foreach ($categories as $category) {
            // PERBAIKAN: Gunakan type_kamar dan filter kategori = 'brilliant'
            $roomsQuery = Kamar::with('camp')
                ->where('type_kamar', $category) // Ubah dari 'kategori' ke 'type_kamar'
                ->where('kategori', 'brilliant') // Tambahkan filter kategori = 'brilliant'
                ->orderBy('nama_kamar');

            // Apply search filter
            if (!empty($this->search)) {
                $roomsQuery->where(function($query) {
                    $query->where('nama_kamar', 'like', '%' . $this->search . '%')
                          ->orWhere('type_kamar', 'like', '%' . $this->search . '%') // Ubah dari 'kategori' ke 'type_kamar'
                          ->orWhereHas('camp', function($campQuery) {
                              $campQuery->where('nama_camp', 'like', '%' . $this->search . '%');
                          });
                });
            }

            $rooms = $roomsQuery->get();

            $roomData[$category] = [
                'putri' => [],
                'putra' => []
            ];

            foreach ($rooms as $room) {
                $status = $this->calculateRoomStatus($room);
                // Sesuaikan dengan enum di migration: 'Laki-laki', 'Perempuan'
                $genderKey = $room->gender === 'Perempuan' ? 'putri' : 'putra';
                
                // Format nama kamar: 'nama camp-nama kamar'
                $displayName = $room->camp 
                    ? $room->camp->nama_camp . '-' . $room->nama_kamar
                    : 'No Camp-' . $room->nama_kamar;
                
                $roomData[$category][$genderKey][] = [
                    'id' => $room->id,
                    'nama' => $displayName,
                    'original_nama' => $room->nama_kamar,
                    'camp_nama' => $room->camp ? $room->camp->nama_camp : 'No Camp',
                    'type_kamar' => $room->type_kamar,
                    'status' => $status['status'],
                    'color' => $status['color'],
                    'bookingInfo' => $status['bookingInfo'],
                    'occupied' => $status['occupied'],
                    'total' => $room->jumlah_kasur,
                    'harga' => $room->harga ?? 0
                ];
            }
        }

        return $roomData;
    }

    private function calculateRoomStatus($room)
    {
        $today = Carbon::now('Asia/Jakarta');
        $totalBeds = $room->jumlah_kasur;
        
        // Hitung berdasarkan jumlah data booking yang ada (per record), bukan quantity
        $occupiedBeds = BookingCalendar::where('kamar_id', $room->id)
            ->where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->count();

        $color = 'bg-green-500'; // Available (hijau)
        if ($occupiedBeds > 0) {
            $color = $occupiedBeds >= $totalBeds ? 'bg-red-500' : 'bg-yellow-500';
        }

        return [
            'status' => $occupiedBeds == 0 ? 'available' : ($occupiedBeds >= $totalBeds ? 'full' : 'partially_occupied'),
            'color' => $color,
            'bookingInfo' => "$occupiedBeds/$totalBeds",
            'occupied' => $occupiedBeds
        ];
    }

    public function getCategoryStats(): array
    {
        $categories = ['regular', 'regular+', 'homestay', 'homestay+', 'vip'];
        $stats = [];

        foreach ($categories as $category) {
            // PERBAIKAN: Gunakan type_kamar dan filter kategori = 'brilliant'
            $roomsQuery = Kamar::where('type_kamar', $category) // Ubah dari 'kategori' ke 'type_kamar'
                ->where('kategori', 'brilliant'); // Tambahkan filter kategori = 'brilliant'

            // Apply search filter for stats
            if (!empty($this->search)) {
                $roomsQuery->where(function($query) {
                    $query->where('nama_kamar', 'like', '%' . $this->search . '%')
                          ->orWhere('type_kamar', 'like', '%' . $this->search . '%') // Ubah dari 'kategori' ke 'type_kamar'
                          ->orWhereHas('camp', function($campQuery) {
                              $campQuery->where('nama_camp', 'like', '%' . $this->search . '%');
                          });
                });
            }

            $rooms = $roomsQuery->get();
            $totalBeds = $rooms->sum('jumlah_kasur');
            $occupiedBeds = 0;

            foreach ($rooms as $room) {
                $roomStatus = $this->calculateRoomStatus($room);
                $occupiedBeds += $roomStatus['occupied'];
            }

            $stats[$category] = [
                'total_rooms' => $rooms->count(),
                'total_beds' => $totalBeds,
                'occupied_beds' => $occupiedBeds,
                'available_beds' => $totalBeds - $occupiedBeds,
                'occupancy_rate' => $totalBeds > 0 ? round(($occupiedBeds / $totalBeds) * 100, 1) : 0
            ];
        }

        return $stats;
    }

    public function getCamps(): array
    {
        // PERBAIKAN: Filter berdasarkan type_kamar dan kategori = 'brilliant'
        $campsQuery = Camp::whereHas('kamar', function($query) {
            $query->whereIn('type_kamar', ['regular', 'regular+', 'homestay', 'homestay+', 'vip']) // Ubah dari 'kategori' ke 'type_kamar'
                  ->where('kategori', 'brilliant'); // Tambahkan filter kategori = 'brilliant'
        })->with('kamar');

        // Apply search filter for camps
        if (!empty($this->search)) {
            $campsQuery->where('nama_camp', 'like', '%' . $this->search . '%');
        }

        $camps = $campsQuery->get();
        $campStatuses = [];

        foreach ($camps as $camp) {
            $targetRooms = $camp->kamar->filter(function($room) {
                // PERBAIKAN: Gunakan type_kamar dan filter kategori = 'brilliant'
                $matchesCategory = in_array($room->type_kamar, ['regular', 'regular+', 'homestay', 'homestay+', 'vip']) 
                                 && $room->kategori === 'brilliant';
                
                if (!empty($this->search)) {
                    $matchesSearch = str_contains(strtolower($room->nama_kamar), strtolower($this->search)) ||
                                   str_contains(strtolower($room->type_kamar), strtolower($this->search)); // Ubah dari 'kategori' ke 'type_kamar'
                    return $matchesCategory && $matchesSearch;
                }
                
                return $matchesCategory;
            });

            if ($targetRooms->count() > 0) {
                $totalStatus = $this->calculateCampStatus($targetRooms);

                $campStatuses[] = [
                    'id' => $camp->id,
                    'label' => $camp->nama_camp,
                    'status' => $totalStatus['status'],
                    'color' => $totalStatus['color'],
                    'bookingInfo' => $totalStatus['bookingInfo']
                ];
            }
        }

        return $campStatuses;
    }

    private function calculateCampStatus($rooms)
    {
        $today = Carbon::now('Asia/Jakarta');
        $totalBeds = 0;
        $occupiedBeds = 0;

        foreach ($rooms as $room) {
            $totalBeds += $room->jumlah_kasur;
            
            $roomBookings = BookingCalendar::where('kamar_id', $room->id)
                ->where('start_date', '<=', $today)
                ->where('end_date', '>=', $today)
                ->count();
                
            $occupiedBeds += $roomBookings;
        }

        $color = 'bg-green-500'; // Available (hijau)
        if ($occupiedBeds > 0) {
            $color = $occupiedBeds >= $totalBeds ? 'bg-red-500' : 'bg-amber-500';
        }

        return [
            'status' => $occupiedBeds == 0 ? 'available' : ($occupiedBeds >= $totalBeds ? 'full' : 'partially_occupied'),
            'color' => $color,
            'bookingInfo' => "$occupiedBeds/$totalBeds"
        ];
    }

    public function getTotalActiveBookings(): int
    {
        $today = Carbon::now('Asia/Jakarta');
        
        // PERBAIKAN: Filter berdasarkan type_kamar dan kategori = 'brilliant'
        $query = BookingCalendar::whereHas('kamar', function($query) {
                $query->whereIn('type_kamar', ['regular', 'regular+', 'homestay', 'homestay+', 'vip']) // Ubah dari 'kategori' ke 'type_kamar'
                      ->where('kategori', 'brilliant'); // Tambahkan filter kategori = 'brilliant'
                
                if (!empty($this->search)) {
                    $query->where(function($subQuery) {
                        $subQuery->where('nama_kamar', 'like', '%' . $this->search . '%')
                                ->orWhere('type_kamar', 'like', '%' . $this->search . '%') // Ubah dari 'kategori' ke 'type_kamar'
                                ->orWhereHas('camp', function($campQuery) {
                                    $campQuery->where('nama_camp', 'like', '%' . $this->search . '%');
                                });
                    });
                }
            })
            ->where('start_date', '<=', $today)
            ->where('end_date', '>=', $today);

        return $query->count();
    }
}
