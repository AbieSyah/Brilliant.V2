<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ModelKamarforAPI;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class KamarController extends Controller
{
    use BaseApiTrait;

    protected function getModelClass()
    {
        return ModelKamarforAPI::class;
    }

    protected function getStoreValidationRules()
    {
        return [
            'nama_kamar' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gender' => 'required|in:pria,wanita,campur',
            'type_kamar' => 'required|in:vip,vvip,regular,barrak',
            'kategori' => 'required|in:bieplus,brilliant_selatan',
            'gambar' => 'nullable|string',
            'harga' => 'required|numeric|min:0'
        ];
    }

    protected function getUpdateValidationRules()
    {
        return [
            'nama_kamar' => 'string|max:255',
            'deskripsi' => 'nullable|string',
            'gender' => 'in:pria,wanita,campur',
            'type_kamar' => 'in:vip,vvip,regular,barrak',
            'kategori' => 'in:bieplus,brilliant_selatan',
            'gambar' => 'nullable|string',
            'harga' => 'numeric|min:0'
        ];
    }

    public function index()
    {
        try {
            $kamar = ModelKamarforAPI::all();
            return response()->json([
                'success' => true,
                'data' => $kamar
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch rooms: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), $this->getStoreValidationRules());

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors()
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $kamar = ModelKamarforAPI::create($request->all());

            return response()->json([
                'status' => 'success',
                'message' => 'Room created successfully',
                'data' => $kamar
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create room: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
            $kamar = ModelKamarforAPI::findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => $kamar
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Room not found'
            ], Response::HTTP_NOT_FOUND);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $kamar = ModelKamarforAPI::findOrFail($id);

            $validator = Validator::make($request->all(), $this->getUpdateValidationRules());

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors()
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $kamar->update($request->all());

            return response()->json([
                'status' => 'success',
                'message' => 'Room updated successfully',
                'data' => $kamar
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update room: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        try {
            $kamar = ModelKamarforAPI::findOrFail($id);
            $kamar->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Room deleted successfully'
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete room: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
