<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminAuthController extends Controller
{
    use BaseApiTrait;

    protected function getModelClass()
    {
        return User::class;
    }

    protected function getStoreValidationRules()
    {
        return [];
    }

    protected function getUpdateValidationRules()
    {
        return [
            'email' => 'sometimes|required|email|unique:users,email',
            'password' => 'sometimes|required|min:6'
        ];
    }

    // Remove login/register methods since we'll use AuthControllerApi
}