<?php

namespace Monitor\Repository;

use Core\Database\DB;
use Exception;


class MonitorResultRepository extends \Core\Repository
{

    public function __construct()
    {
        $this->archiveMode = static::ArchiveMode_OnlyExisting;
    }
    public function defaultTable(): string
    {
        return 'monitor_result';
    }
    public function getDataTable($options)
    {
        $start = (int)$options->start;
        $limit = (int)$options->limit;
        $sqlOrder = $this->getOrderSQL($options);
        $rows = DB::get("SELECT * FROM monitor_result $sqlOrder LIMIT $start,$limit");
        $total = DB::get("SELECT count(*) as count FROM monitor_result")[0]->count;
        return ['rows' => $rows, 'total' => $total];
    }
        private function getOrderSQL($options)
    {
        if (empty($options->sort))
            return "";
        else {
            $mapping = ['monitor_id'=> 'monitor_id', 'stamp'=> 'stamp', 'responseTime'=> 'responseTime', 'isSuccess'=> 'isSuccess', 'status'=> 'status'];
            if (empty($mapping[$options->sort->col]))
                throw new Exception();
            return ' ORDER BY '.DB::safeKey($mapping[$options->sort->col]).' '.($options->sort->desc ? 'DESC' : 'ASC').' ';
        }
    }    public function getAll()
    {
        if($this->archiveMode == static::ArchiveMode_OnlyExisting)
            return DB::get("SELECT * FROM monitor_result WHERE is_archived = 0");
        else
            return DB::get("SELECT * FROM monitor_result");
    }
}
