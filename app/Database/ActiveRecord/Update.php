<?php

namespace App\Database\ActiveRecord;

use App\Database\Connection\Connection;
use App\Database\Interfaces\ActiveRecordExecuteInterface;
use App\Database\Interfaces\ActiveRecordInterface;
use App\Database\Interfaces\UpdateInterface;

class Update extends Base implements ActiveRecordExecuteInterface
{
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
