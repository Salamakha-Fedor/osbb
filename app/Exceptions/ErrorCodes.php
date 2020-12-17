<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class ErrorCodes extends ExceptionHandler
{
    const SERVER_ERROR = 1;

    const UNAUTHORIZED = 2;

    const TOKEN_MISMATCH = 3;

    const FORBIDDEN = 4;

    const NOT_FOUND = 5;

    const METHOD_NOT_EXISTS = 6;

    const VALIDATION_ERROR = 7;

    const THROTTLED = 8;

    const WRONG_CODE = 9;

    const CODE_EXPIRED = 10;

    const USER_NOT_FOUND = 11;

    const ERROR_CODES = [
        self::SERVER_ERROR => 'Произошла ошибка',
        self::UNAUTHORIZED => 'Пользователь не авторизован',
        self::TOKEN_MISMATCH => 'Неверный токен',
        self::FORBIDDEN => 'Нет доступа',
        self::NOT_FOUND => 'Путь не найден',
        self::METHOD_NOT_EXISTS => 'Метод не найден',
        self::VALIDATION_ERROR => 'Ошибка валидации',
        self::THROTTLED => 'Слишком много попыток. Попробуйте через несколько секунд',
        self::WRONG_CODE => 'Неверный код',
        self::CODE_EXPIRED => 'Время жизни кода истекло',
        self::USER_NOT_FOUND => 'Такой пользователь не найден',
    ];
}
