<?php

namespace App\Http\Controllers\Api;

use App\Models\BookingCalendar;
use App\Models\Kamar;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookingCalendarController extends Controller
{
    use BaseApiTrait;

    protected function getModelClass()
    {
        return BookingCalendar::class;
    }

    protected function getStoreValidationRules()
    {
        return [
            'kamar_id' => 'required|exists:kamar,id',
            'nama' => 'required|string',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'quantity' => 'required|integer|min:1'
        ];
    }

    protected function getUpdateValidationRules()
    {
        return [
            'kamar_id' => 'sometimes|required|exists:kamar,id',
            'start_date' => 'sometimes|required|date',
            'end_date' => 'sometimes|required|date|after:start_date',
            'quantity' => 'sometimes|required|integer|min:1'
        ];
    }

    // Tambahkan method untuk mendapatkan detail kamar sebelum booking
    public function getKamarDetail($id)
    {
        try {
            // Get the kamar details
            $kamar = Kamar::findOrFail($id);
            
            // Get all bookings for this kamar
            $bookings = BookingCalendar::where('kamar_id', $id)
                ->select('id', 'nama', 'gender', 'start_date', 'end_date')
                ->orderBy('start_date')
                ->get();

            return response()->json([
                'status' => true,
                'message' => 'Data kamar retrieved successfully',
                'data' => [
                    'kamar' => $kamar,
                    'bookings' => $bookings
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve kamar data',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate($this->getStoreValidationRules());
            
            // Get kamar detail first
            $kamar = Kamar::with('camp')->findOrFail($validatedData['kamar_id']);
            
            $booking = BookingCalendar::create($validatedData);

            return response()->json([
                'status' => true,
                'message' => 'Booking berhasil ditambahkan',
                'data' => [
                    'booking' => $booking,
                    'kamar_detail' => [
                        'kamar_id' => $kamar->id,
                        'nama_kamar' => $kamar->nama_kamar,
                        'type_kamar' => $kamar->type_kamar,
                        'kategori' => $kamar->kategori
                    ]
                ]
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menambahkan booking',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function checkBookings($id)
    {
        try {
            $bookings = BookingCalendar::where('kamar_id', $id)
                ->select('id', 'nama', 'gender', 'start_date', 'end_date', 'quantity')
                ->orderBy('start_date')
                ->get();

            return response()->json([
                'status' => true,
                'message' => 'Booking data retrieved successfully',
                'data' => $bookings
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve booking data',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}