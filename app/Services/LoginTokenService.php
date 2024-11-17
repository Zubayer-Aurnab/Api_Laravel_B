<?php


namespace App\Service;

use App\Http\Resources\ErrorResource;
use App\Http\Resources\SuccessResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

trait LoginTokenService
{
    public function loginToken(array $creadentials): Model
    {

        $user = User::where('email', $creadentials['email'])->first();
        if ($user && Hash::check($creadentials['password'], $user->password)) {
            $respose = [
                'message' => 'Log in Token Generated Successfully',
                'data' => [
                    'token' => $token->plainTextToken
                ]
            ];
            return new SuccessResource(['data' => $respose]);
        }
        $errors['email'][] = __('auth.failed');
        return (new ErrorResource($errors))->response()->setStatusCode(422);
    }
}
