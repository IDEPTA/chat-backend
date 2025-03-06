<?php

namespace App\Services;

use App\Models\Chat;
use App\Http\Requests\ChatRequest;
use Exception;

class ChatService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        $chats = Chat::all();
        return $chats;
    }

    public function show(string $id)
    {
        $chat = Chat::find($id);

        if (is_null($chat)) {
            throw new Exception('Чат не найден', 404);
        }
        return $chat;
    }

    public function create(ChatRequest $request)
    {
        $data = $request->validated();
        $newChat = Chat::create($data);

        return $newChat;
    }

    public function update(ChatRequest $request, string $id)
    {
        $data = $request->validated();
        $updatedChat = $this->show($id);
        $updatedChat->update($data);

        return $updatedChat;
    }

    public function delete(string $id)
    {
        $deletedChat = $this->show($id);
        $deletedChat->delete();
    }
}