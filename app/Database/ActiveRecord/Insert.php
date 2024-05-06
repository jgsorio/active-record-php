<?php

namespace App\Database\ActiveRecord;

use App\Database\Connection\Connection;
use App\Database\Interfaces\ActiveRecordExecuteInterface;
use App\Database\Interfaces\ActiveRecordInterface;
use PDO;

class Insert implements ActiveRecordExecuteInterface
{
    protected ?PDO $pdo;

    public function __construct()
    {
        $this->pdo = Connection::connect();
    }
    public function execute(ActiveRecordInterface $record)
    {
        $sql = "INSERT INTO {$record->getTable()} (";
        $sql .= implode(',', array_keys($record->getAttributes())) . ") VALUES (:";
        $sql .= implode(',:', array_keys($record->getAttributes())) . ")";
        $prepare = $this->pdo->prepare($sql);
        $prepare->execute($record->getAttributes());
        return $prepare->rowCount();
    }
}