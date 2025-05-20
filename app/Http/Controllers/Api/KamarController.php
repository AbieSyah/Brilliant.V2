<?php

namespace App\Http\Controllers\Api;

use App\Models\Kamar;
use App\Models\DetailKamar;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class KamarController extends Controller
{
    use BaseApiTrait;

    protected function getModelClass()
    {
        return Kamar::class;
    }

    protected function getStoreValidationRules()
    {
        return [
            'nama_kamar' => 'required|string',
            'deskripsi' => 'nullable|string',

            // DetailKamar validation
            'type_kamar' => 'required|string',
            'kategori' => 'required|string',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'jumlah_kasur' => 'required|integer',
            'fasilitas' => 'nullable|string',
            'peraturan' => 'nullable|string',
            'gambar' => 'nullable|string',
            'harga' => 'required|numeric',
            'catatan_tambahan' => 'nullable|string'
        ];
    }

    protected function getUpdateValidationRules()
    {
        return [
            'nama_kamar' => 'sometimes|required|string',
            'deskripsi' => 'nullable|string',
            'gender' => 'nullable|in:Laki-laki,Perempuan',
            'type_kamar' => 'nullable|string',
            'kategori' => 'nullable|string',
            'gambar' => 'nullable|string',
            'harga' => 'sometimes|required|numeric'
        ];
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $validatedData = $request->validate([
                'nama_kamar' => 'required|string',
                'deskripsi' => 'nullable|string',
                
                // DetailKamar validation
                'alamat' => 'nullable|string',
                'type_kamar' => 'required|string',
                'kategori' => 'required|string',
                'gender' => 'required|in:Laki-laki,Perempuan',
                'jumlah_kasur' => 'required|integer',
                'fasilitas' => 'nullable|string',
                'peraturan' => 'nullable|string',
                'gambar' => 'nullable|string',
                'harga' => 'required|numeric',
                'catatan_tambahan' => 'nullable|string',
            ]);

            // Create Kamar
            $kamar = Kamar::create([
                'nama_kamar' => $validatedData['nama_kamar'],
                'deskripsi' => $validatedData['deskripsi'],
            ]);

            // Create DetailKamar
            $detailKamar = DetailKamar::create([
                'kamar_id' => $kamar->id,
                'alamat' => $validatedData['alamat'],
                'type_kamar' => $validatedData['type_kamar'],
                'kategori' => $validatedData['kategori'],
                'gender' => $validatedData['gender'],
                'jumlah_kasur' => $validatedData['jumlah_kasur'],
                'fasilitas' => $validatedData['fasilitas'],
                'peraturan' => $validatedData['peraturan'],
                'gambar' => $validatedData['gambar'],
                'harga' => $validatedData['harga'],
                'catatan_tambahan' => $validatedData['catatan_tambahan'],
            ]);


            DB::commit();

            return response()->json([
                'message' => 'Data created successfully',
                'kamar' => $kamar,
                'detail_kamar' => $detailKamar
            ], Response::HTTP_CREATED);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to create data',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(string $id)
    {
        try {
            $kamar = Kamar::with('detailKamar')->findOrFail($id);

            return response()->json([
                'status' => true,
                'message' => 'Data retrieved successfully',
                'data' => [
                    'kamar' => [
                        'id' => $kamar->id,
                        'nama_kamar' => $kamar->nama_kamar,
                        'deskripsi' => $kamar->deskripsi
                    ],
                    'detail_kamar' => $kamar->detailKamar ? [
                        'id' => $kamar->detailKamar->id,
                        'alamat' => $kamar->detailKamar->alamat,
                        'type_kamar' => $kamar->detailKamar->type_kamar,
                        'kategori' => $kamar->detailKamar->kategori,
                        'gender' => $kamar->detailKamar->gender,
                        'jumlah_kasur' => $kamar->detailKamar->jumlah_kasur,
                        'fasilitas' => $kamar->detailKamar->fasilitas,
                        'peraturan' => $kamar->detailKamar->peraturan,
                        'gambar' => $kamar->detailKamar->gambar,
                        'harga' => $kamar->detailKamar->harga,
                        'catatan_tambahan' => $kamar->detailKamar->catatan_tambahan
                    ] : null
                ]
            ], Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Data mengenai kamar tersebut tidak ditemukan'
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Server error',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}