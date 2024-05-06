<?php

namespace App\Database\ActiveRecord;

use App\Database\Connection\Connection;
use App\Database\Interfaces\ActiveRecordExecuteInterface;
use App\Database\Interfaces\ActiveRecordInterface;
use App\Database\Interfaces\UpdateInterface;
use PDO;

class Update implements ActiveRecordExecuteInterface
{
    protected ?PDO $pdo = null;

    public function __construct()
    {
        $this->pdo = Connection::connect();
    }
    public function execute(ActiveRecordInterface $record)
    {
        $sql = "UPDATE {$record->getTable()} SET ";
        foreach ($record->getAttributes() as $name => $value) {
            $sql .= "{$name} = :{$name}, ";
        }
        $sql = rtrim($sql, ', ');
        $sql .= " WHERE id = :id";
        $prepare = $this->pdo->prepare($sql);
        $prepare->execute($record->getAttributes());
        return $prepare->rowCount();
    }
}
