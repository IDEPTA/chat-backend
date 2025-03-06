<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChatRequest;
use Throwable;
use Illuminate\Http\Request;
use App\Services\ChatService;

class ChatController extends Controller
{
    public function __construct(
        private readonly ChatService $chatService
    ) {}

    public function index()
    {
        try {
            $chats = $this->chatService->index();
            return response()->json([
                "success" => true,
                "data" => $chats
            ]);
        } catch (Throwable $th) {
            return $this->errorMessage($th);
        }
    }

    public function show(string $id)
    {
        try {
            $chat = $this->chatService->show($id);
            return response()->json([
                "success" => true,
                "data" => $chat
            ]);
        } catch (Throwable $th) {
            return $this->errorMessage($th);
        }
    }

    public function create(ChatRequest $request)
    {
        try {
            $newChat = $this->chatService->create($request);
            return response()->json([
                "success" => true,
                "data" => $newChat
            ]);
        } catch (Throwable $th) {
            return $this->errorMessage($th);
        }
    }

    public function update(ChatRequest $request, string $id)
    {
        try {
            $updatedChat = $this->chatService->update($request, $id);
            return response()->json([
                "success" => true,
                "data" => $updatedChat
            ]);
        } catch (Throwable $th) {
            return $this->errorMessage($th);
        }
    }

    public function delete(string $id)
    {
        try {
            $this->chatService->delete($id);
            return response()->json([
                "success" => true,
                "msg" => "Чат удален"
            ]);
        } catch (Throwable $th) {
            return $this->errorMessage($th);
        }
    }

    public function errorMessage(Throwable $th)
    {
        return response()->json([
            "success" => false,
            "msg" => $th->getMessage()
        ], $th->getCode());
    }
}