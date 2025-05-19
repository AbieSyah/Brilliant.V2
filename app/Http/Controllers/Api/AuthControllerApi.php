<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin; // Change from User to Admin
use Auth;
use Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class AuthControllerApi extends Controller
{
    public function requestToken(Request $request): JsonResponse
    {
        $validator = \Validator::make($request->all(), [
            'email' => 'required|string|max:255',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        
        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return response()->json([
                'message' => 'User not found or password mismatch'
            ], 401);
        }

        $token = $admin->createToken('admin_auth_token')->plainTextToken;

        return response()->json([
            'id' => $admin->id,
            'token' => $token,
        ], Response::HTTP_OK);
    }
}
