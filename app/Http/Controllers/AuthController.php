<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\AuthService;

class AuthController extends Controller
{
    public function __construct(
        private readonly AuthService $authService
    ) {}

    // public function errorMessage() {}

    public function login(LoginRequest $request)
    {
        try {
            $token = $this->authService->login($request);
            return response()->json([
                "msg" => "Авторизация успешна",
                "token" => $token,
                "success" => true
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "msg" => $th->getMessage(),
                "success" => false
            ], $th->getCode());
        }
    }

    public function register(RegisterRequest $request)
    {
        try {
            $token = $this->authService->register($request);
            return response()->json([
                "msg" => "Регистрация успешна",
                "token" => $token,
                "success" => true
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "msg" => $th->getMessage(),
                "success" => false
            ], $th->getCode());
        }
    }
}
