<?php

namespace App\Services;

use App\Http\Requests\MessageRequest;
use Exception;
use App\Models\Message;

class MessageService
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
        $chats = Message::with("user", "chat")->get();
        return $chats;
    }

    public function show(string $id)
    {
        $chat = Message::with("user", "chat")->find($id);

        if (is_null($chat)) {
            throw new Exception('Сообщение не найдено', 404);
        }
        return $chat;
    }

    public function create(MessageRequest $request)
    {
        $data = $request->validated();
        $newChat = Message::create($data);

        return $newChat;
    }

    public function update(MessageRequest $request, string $id)
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