<?php

namespace App\Http\Controllers\Api;

use App\Models\Kamar;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
            'camp_id' => 'required|exists:camp,id',
            'nama_kamar' => 'nullable|string',
            'type_kamar' => 'required|string',
            'kategori' => 'required|string',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'jumlah_kasur' => 'required|integer|min:1',
            'fasilitas' => 'nullable|string',
            'peraturan' => 'nullable|string',
            'gambar' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'catatan_tambahan' => 'nullable|string'
        ];
    }

    protected function getUpdateValidationRules()
    {
        return [
            'nama_kamar' => 'nullable|string',
            'type_kamar' => 'sometimes|required|string',
            'kategori' => 'sometimes|required|string',
            'gender' => 'sometimes|required|in:Laki-laki,Perempuan',
            'jumlah_kasur' => 'sometimes|required|integer|min:1',
            'fasilitas' => 'nullable|string',
            'peraturan' => 'nullable|string',
            'gambar' => 'nullable|string',
            'harga' => 'sometimes|required|numeric|min:0',
            'catatan_tambahan' => 'nullable|string'
        ];
    }

    public function show(string $id)
    {
        try {
            $kamar = Kamar::with('camp')->findOrFail($id);
            
            return response()->json([
                'status' => true,
                'message' => 'Data retrieved successfully',
                'data' => $kamar
            ], Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Kamar not found'
            ], Response::HTTP_NOT_FOUND);
        }
    }
}