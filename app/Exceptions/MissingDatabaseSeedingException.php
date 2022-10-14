<?php

namespace App\Exceptions;

use RuntimeException;

class MissingDatabaseSeedingException extends RuntimeException
{
    public function __construct(string $message = "数据库没有填充初始数据！")
    {
        parent::__construct($message);
    }
}
