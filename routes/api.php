<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\MessageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(AuthController::class)->group(function () {
    Route::post("login",  "login");
    Route::post("register",  "register");
});

Route::controller(ChatController::class)->group(function () {
    Route::get("chats",  "index");
    Route::get("chats/{id}",  "show");
    Route::post("chats",  "create");
    Route::put("chats/{id}",  "update");
    Route::delete("chats/{id}",  "delete");
});

Route::controller(MessageController::class)->group(function () {
    Route::get("messages",  "index");
    Route::get("messages/{id}",  "show");
    Route::post("messages",  "create");
    Route::put("messages/{id}",  "update");
    Route::delete("messages/{id}",  "delete");
});