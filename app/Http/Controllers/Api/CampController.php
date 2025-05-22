<?php

namespace App\Http\Controllers\Api;

use App\Models\Camp;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CampController extends Controller
{
    use BaseApiTrait;

    protected function getModelClass()
    {
        return Camp::class;
    }

    protected function getStoreValidationRules()
    {
        return [
            'nama_camp' => 'required|string',
            'deskripsi' => 'nullable|string',
            'gambar_camp' => 'nullable|string',
            'alamat' => 'required|string',
            'jumlah_maksimal_kamar' => 'required|integer|min:1'
        ];
    }

    protected function getUpdateValidationRules()
    {
        return [
            'nama_camp' => 'sometimes|required|string',
            'deskripsi' => 'nullable|string',
            'gambar_camp' => 'nullable|string',
            'alamat' => 'sometimes|required|string',
            'jumlah_maksimal_kamar' => 'sometimes|required|integer|min:1'
        ];
    }

    public function show(string $id)
    {
        try {
            $camp = Camp::with('kamar')->findOrFail($id);
            
            return response()->json([
                'status' => true,
                'message' => 'Data retrieved successfully',
                'data' => $camp
            ], Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Camp not found'
            ], Response::HTTP_NOT_FOUND);
        }
    }
}