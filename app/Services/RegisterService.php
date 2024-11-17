<?php

namespace App\Service;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

trait RegisterService
{
    public function creatUser(array $data): Model
    {
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        return $user;
    }
}
