<?php

namespace App\Database\Connection;

use PDO;
use PDOException;
class Connection
{
    protected static ?PDO $pdo = null;

    public static function connect(): ?PDO
    {
        try {
            if (!self::$pdo) {
                self::$pdo = new PDO('mysql:host=database;dbname=active_record', 'root', 'root', [
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                ]);
            }

            return self::$pdo;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}
