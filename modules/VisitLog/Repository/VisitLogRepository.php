<?php

namespace VisitLog\Repository;

use Core\Database\DB;
use Exception;


class VisitLogRepository extends \Core\Repository
{

    public function __construct()
    {
        $this->archiveMode = static::ArchiveMode_OnlyExisting;
    }
    public function defaultTable(): string
    {
        return 'visit_log';
    }
    public function getDataTable($options)
    {
        $start = (int)$options->start;
        $limit = (int)$options->limit;
        $sqlOrder = $this->getOrderSQL($options);
        $rows = DB::get("SELECT * FROM visit_log $sqlOrder LIMIT $start,$limit");
        $total = DB::get("SELECT count(*) as count FROM visit_log")[0]->count;
        return ['rows' => $rows, 'total' => $total];
    }
        private function getOrderSQL($options)
    {
        if (empty($options->sort))
            return "";
        else {
            $mapping = ['project_id'=> 'project_id', 'userIdentifier'=> 'userIdentifier', 'userAgent'=> 'userAgent', 'ipAddress'=> 'ipAddress', 'sessionIdentifier'=> 'sessionIdentifier', 'pageOpenIdentifier'=> 'pageOpenIdentifier', 'url'=> 'url', 'created'=> 'created', 'added'=> 'added', 'type'=> 'type'];
            if (empty($mapping[$options->sort->col]))
                throw new Exception();
            return ' ORDER BY '.DB::safeKey($mapping[$options->sort->col]).' '.($options->sort->desc ? 'DESC' : 'ASC').' ';
        }
    }    public function getAll()
    {
        if($this->archiveMode == static::ArchiveMode_OnlyExisting)
            return DB::get("SELECT * FROM visit_log WHERE is_archived = 0");
        else
            return DB::get("SELECT * FROM visit_log");
    }
}