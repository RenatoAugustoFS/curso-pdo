<?php

namespace Alura\Pdo\Infrastructure\Persistence;

use PDO;

class ConnectionCreator
{
    public static function createConnection()
    {
        $caminhoBanco = __DIR__ . '../../../../banco.sqlite';
        $conection = new PDO('sqlite:' . $caminhoBanco);
        $conection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $conection;
    }
}