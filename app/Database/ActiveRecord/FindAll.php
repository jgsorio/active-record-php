<?php

namespace App\Database\ActiveRecord;

use App\Database\Interfaces\ActiveRecordExecuteInterface;
use App\Database\Interfaces\ActiveRecordInterface;

class FindAll extends Base implements ActiveRecordExecuteInterface
{
    public function execute(ActiveRecordInterface $record)
    {
        $filter = !empty($record->getAttributes()) ? ' WHERE ' : null;
        $sql = "SELECT * FROM {$record->getTable()} {$filter}";
        foreach ($record->getAttributes() as $name => $value) {
            $sql .= "{$name} = :{$name} AND ";
        }
        $sql = rtrim($sql, ' AND ');
        $prepare = $this->pdo->prepare($sql);
        $prepare->execute(
            !empty($record->getAttributes()) ? $record->getAttributes() : []
        );
        return $prepare->fetchAll();
    }
}
