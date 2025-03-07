<?php

namespace App\Services;

use Exception;
use App\Models\Message;
use App\Events\MessageCreated;
use App\Events\MessageDeleted;
use App\Events\MessageUpdated;
use App\Http\Requests\MessageRequest;

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
        $messages = Message::with("user", "chat")->get();
        return $messages;
    }

    public function show(string $id)
    {
        $message = Message::with("user", "chat")->find($id);

        if (is_null($message)) {
            throw new Exception('Сообщение не найдено', 404);
        }
        return $message;
    }

    public function create(MessageRequest $request)
    {
        $data = $request->validated();
        $newMessage = Message::create($data);
        MessageCreated::dispatch($newMessage->load("user", "chat"));


        return $newMessage;
    }

    public function update(MessageRequest $request, string $id)
    {
        $data = $request->validated();
        $updatedMessage = $this->show($id);
        $updatedMessage->update($data);
        MessageUpdated::dispatch($updatedMessage->load("user", "chat"));
        return $updatedMessage;
    }

    public function delete(string $id)
    {
        $deletedMessage = $this->show($id);
        MessageDeleted::dispatch($deletedMessage);
        $deletedMessage->delete();
    }
}
