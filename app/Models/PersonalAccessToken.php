<?php

namespace App\Models;

use Laravel\Sanctum\PersonalAccessToken as SanctumToken;
use MongoDB\Laravel\Eloquent\DocumentModel;

class PersonalAccessToken extends SanctumToken
{
    use DocumentModel; // подключаем поддержку MongoDB

    protected $connection = 'mongodb'; // указываем подключение к MongoDB
    protected $table = 'personal_access_tokens'; // указываем имя коллекции
    protected $keyType = 'string'; // задаем тип ключа
}
