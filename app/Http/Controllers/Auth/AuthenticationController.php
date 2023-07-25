<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function register(RegisterRequest $request){
        $request -> validated();
        $userData = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];
        $user = User::create($userData);
        $token = $user->createToken('forumapp')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ],201);
    }
}
