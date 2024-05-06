<?php

namespace App\Database\ActiveRecord;

use App\Database\Connection\Connection;
use PDO;
abstract class Base
{
    protected PDO $pdo;

    public function __construct()
    {
        $this->pdo = Connection::connect();
    }
}