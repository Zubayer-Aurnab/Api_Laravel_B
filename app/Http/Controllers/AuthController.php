<?php

namespace App\Http\Controllers;

use App\Http\Resources\SuccessResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function user(Request $request)
    {
        $response['data'] = new UserResource($request->user());
        return new SuccessResource(['data' => $response]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        $response['message'] = 'Successfully Logout';
        return new SuccessResource(['message' => $response]);
    }
}
