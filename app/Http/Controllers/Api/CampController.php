<?php

namespace App\Http\Controllers\Api;

use App\Models\Camp;
use App\Models\Kamar; // Add this line
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;

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
            'gambar_camp' => 'nullable|file|image|mimes:jpeg,png,jpg|max:2048', 
            'alamat' => 'required|string',
            'jumlah_maksimal_kamar' => 'required|integer|min:1'
        ];
    }

    protected function getUpdateValidationRules()
    {
        return [
            'nama_camp' => 'sometimes|required|string',
            'deskripsi' => 'nullable|string',
            'gambar_camp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
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

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama_camp' => 'required|string',
                'deskripsi' => 'nullable|string',
                'gambar_camp' => 'nullable|file|image|mimes:jpeg,png,jpg|max:2048',
                'alamat' => 'required|string',
                'jumlah_maksimal_kamar' => 'required|integer',
            ]);

            if ($request->hasFile('gambar_camp')) {
                $file = $request->file('gambar_camp');
                $fileName = time() . '_' . $file->getClientOriginalName();
                
                // Store in public_path directly
                $file->move(public_path('uploads/camp'), $fileName);
                $validatedData['gambar_camp'] = 'uploads/camp/' . $fileName;
            }

            $camp = Camp::create($validatedData);

            return response()->json([
                'status' => true,
                'message' => 'Camp created successfully',
                'data' => $camp
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $camp = Camp::findOrFail($id);
            
            $validatedData = $request->validate([
                'nama_camp' => 'nullable|string',
                'deskripsi' => 'nullable|string',
                'gambar_camp' => 'nullable|file|image|mimes:jpeg,png,jpg|max:2048',
                'alamat' => 'nullable|string',
                'jumlah_maksimal_kamar' => 'nullable|integer',
            ]);

            if ($request->hasFile('gambar_camp')) {
                // Delete old image if exists
                if ($camp->gambar_camp) {
                    $oldImagePath = public_path($camp->gambar_camp);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                // Save new image
                $file = $request->file('gambar_camp');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/camp'), $fileName);
                $validatedData['gambar_camp'] = 'uploads/camp/' . $fileName;
            }

            $camp->update($validatedData);

            return response()->json([
                'status' => true,
                'message' => 'Camp updated successfully',
                'data' => $camp
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }

    public function getKamarTypes($id) // Add this function
    {
        try {
            $types = Kamar::where('camp_id', $id)
                ->select('type_kamar')
                ->distinct()
                ->pluck('type_kamar');
                
            return response()->json([
                'status' => true,
                'data' => $types
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}