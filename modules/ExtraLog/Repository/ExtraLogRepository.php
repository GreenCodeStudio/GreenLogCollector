<?php

namespace ExtraLog\Repository;

use Core\Database\DB;
use Exception;


class ExtraLogRepository extends \Core\Repository
{

    public function __construct()
    {
        $this->archiveMode = static::ArchiveMode_OnlyExisting;
    }
    public function defaultTable(): string
    {
        return 'extra_log';
    }
    public function getDataTable($options)
    {
        $start = (int)$options->start;
        $limit = (int)$options->limit;
        $sqlOrder = $this->getOrderSQL($options);
        $rows = DB::get("SELECT * FROM extra_log $sqlOrder LIMIT $start,$limit");
        $total = DB::get("SELECT count(*) as count FROM extra_log")[0]->count;
        return ['rows' => $rows, 'total' => $total];
    }
        private function getOrderSQL($options)
    {
        if (empty($options->sort))
            return "";
        else {
            $mapping = ['project_id'=> 'project_id', 'pageOpenIdentifier'=> 'pageOpenIdentifier', 'created'=> 'created', 'added'=> 'added', 'source'=> 'source', 'type'=> 'type', 'data'=> 'data'];
            if (empty($mapping[$options->sort->col]))
                throw new Exception();
            return ' ORDER BY '.DB::safeKey($mapping[$options->sort->col]).' '.($options->sort->desc ? 'DESC' : 'ASC').' ';
        }
    }    public function getAll()
    {
        if($this->archiveMode == static::ArchiveMode_OnlyExisting)
            return DB::get("SELECT * FROM extra_log WHERE is_archived = 0");
        else
            return DB::get("SELECT * FROM extra_log");
    }
}