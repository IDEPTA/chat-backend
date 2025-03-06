<?php

namespace App\Services\Auth;

use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;

class AuthService
{
    /**
     * Create a new class instance.
     */
    public function __construct() {}

    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        $user = User::where("email", $data['login'])->first();

        if ($user && Hash::check($data['password'], $user->password)) {
            $token = $user->createToken("auth_token")->plainTextToken;

            return $token;
        }

        throw new Exception("Неверный логин или пароль", 401);
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $newUser = User::create($data);
        $token = $newUser->createToken("auth_token")->plainTextToken;

        return $token;
    }
}
