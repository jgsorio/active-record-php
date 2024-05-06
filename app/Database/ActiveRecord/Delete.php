<?php

namespace App\Database\ActiveRecord;

use App\Database\Interfaces\ActiveRecordExecuteInterface;
use App\Database\Interfaces\ActiveRecordInterface;

class Delete extends Base implements ActiveRecordExecuteInterface
{
    public function execute(ActiveRecordInterface $record)
    {
        $sql = "DELETE from {$record->getTable()} WHERE id = :id";
        $prepare = $this->pdo->prepare($sql);
        $prepare->execute($record->getAttributes());
        return $prepare->rowCount();
    }
}
