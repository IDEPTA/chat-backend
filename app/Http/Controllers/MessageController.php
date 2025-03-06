<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use Throwable;
use Illuminate\Http\Request;
use App\Services\MessageService;

class MessageController extends Controller
{
    public function __construct(
        private readonly MessageService $messageService
    ) {}

    public function index()
    {
        try {
            $chats = $this->messageService->index();
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
            $chat = $this->messageService->show($id);
            return response()->json([
                "success" => true,
                "data" => $chat
            ]);
        } catch (Throwable $th) {
            return $this->errorMessage($th);
        }
    }

    public function create(MessageRequest $request)
    {
        try {
            $newChat = $this->messageService->create($request);
            return response()->json([
                "success" => true,
                "data" => $newChat
            ]);
        } catch (Throwable $th) {
            return $this->errorMessage($th);
        }
    }

    public function update(MessageRequest $request, string $id)
    {
        try {
            $updatedChat = $this->messageService->update($request, $id);
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
            $this->messageService->delete($id);
            return response()->json([
                "success" => true,
                "msg" => "Сообщение удалено"
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