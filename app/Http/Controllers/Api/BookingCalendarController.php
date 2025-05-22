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
            $kamar = Kamar::with('camp')->findOrFail($id);
            
            return response()->json([
                'status' => true,
                'message' => 'Data kamar retrieved successfully',
                'data' => [
                    'kamar_id' => $kamar->id,
                    'nama_kamar' => $kamar->nama_kamar,
                    'type_kamar' => $kamar->type_kamar,
                    'kategori' => $kamar->kategori,
                    'alamat' => $kamar->camp->alamat,
                    'harga' => $kamar->harga
                ]
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve kamar detail',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $this->validate($request, $this->getStoreValidationRules());
            
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
}