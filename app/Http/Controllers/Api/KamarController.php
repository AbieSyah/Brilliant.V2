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

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama_kamar' => 'required|string',
                'camp_id' => 'required|exists:camp,id',
                'type_kamar' => 'required|string',
                'kategori' => 'required|string',
                'gender' => 'required|string',
                'jumlah_kasur' => 'required|integer',
                'fasilitas' => 'nullable|string',
                'peraturan' => 'nullable|string',
                'gambar' => 'nullable|file|image|mimes:jpeg,png,jpg|max:2048',
                'harga' => 'required|numeric',
                'catatan_tambahan' => 'nullable|string',
            ]);

            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path("uploads/camp/{$request->camp_id}/kamar"), $fileName);
                $validatedData['gambar'] = "uploads/camp/{$request->camp_id}/kamar/" . $fileName;
            }

            $kamar = Kamar::create($validatedData);

            return response()->json([
                'status' => true,
                'message' => 'Kamar created successfully',
                'data' => $kamar
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
            $kamar = Kamar::findOrFail($id);
            
            $validatedData = $request->validate([
                'nama_kamar' => 'nullable|string',
                'type_kamar' => 'nullable|string',
                'kategori' => 'nullable|string',
                'gender' => 'nullable|string',
                'jumlah_kasur' => 'nullable|integer',
                'fasilitas' => 'nullable|string',
                'peraturan' => 'nullable|string',
                'gambar' => 'nullable|file|image|mimes:jpeg,png,jpg|max:2048',
                'harga' => 'nullable|numeric',
                'catatan_tambahan' => 'nullable|string',
            ]);

            if ($request->hasFile('gambar')) {
                // Delete old image if exists
                if ($kamar->gambar) {
                    $oldImagePath = public_path($kamar->gambar);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                // Save new image
                $file = $request->file('gambar');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path("uploads/camp/{$kamar->camp_id}/kamar"), $fileName);
                $validatedData['gambar'] = "uploads/camp/{$kamar->camp_id}/kamar/" . $fileName;
            }

            $kamar->update($validatedData);

            return response()->json([
                'status' => true,
                'message' => 'Kamar updated successfully',
                'data' => $kamar
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }

    public function getTypesByCamp($campId)
    {
        try {
            $types = Kamar::where('camp_id', $campId)
                ->select('type_kamar')
                ->distinct()
                ->pluck('type_kamar')
                ->toArray();

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

    public function getByType($campId, $type)
    {
        try {
            $kamars = Kamar::where('camp_id', $campId)
                ->where('type_kamar', $type)
                ->get();

            return response()->json([
                'status' => true,
                'data' => $kamars
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}