<?php

namespace Monitor\Repository;

use Core\Database\DB;
use Exception;


class MonitorRepository extends \Core\Repository
{

    public function __construct()
    {
        $this->archiveMode = static::ArchiveMode_OnlyExisting;
    }

    public function defaultTable(): string
    {
        return 'monitor';
    }

    public function getDataTable($options)
    {
        $start = (int)$options->start;
        $limit = (int)$options->limit;
        $sqlOrder = $this->getOrderSQL($options);
        $rows = DB::get("SELECT * FROM monitor $sqlOrder LIMIT $start,$limit");
        $total = DB::get("SELECT count(*) as count FROM monitor")[0]->count;
        return ['rows' => $rows, 'total' => $total];
    }

    private function getOrderSQL($options)
    {
        if (empty($options->sort))
            return "";
        else {
            $mapping = ['name' => 'name', 'address' => 'address', 'type' => 'type', 'project_id' => 'project_id'];
            if (empty($mapping[$options->sort->col]))
                throw new Exception();
            return ' ORDER BY '.DB::safeKey($mapping[$options->sort->col]).' '.($options->sort->desc ? 'DESC' : 'ASC').' ';
        }
    }

    public function getAll()
    {
        if ($this->archiveMode == static::ArchiveMode_OnlyExisting)
            return DB::get("SELECT * FROM monitor WHERE is_archived = 0");
        else
            return DB::get("SELECT * FROM monitor");
    }

    public function getToShow(int $id)
    {
        $item = DB::get("
SELECT m.*,
       (SELECT JSON_OBJECT('stamp', mr.stamp, 'responseTime', mr.response_time, 'isSuccess', mr.is_success, 'status', mr.status) FROM monitor_result mr WHERE mr.monitor_id = m.id ORDER BY stamp DESC LIMIT 1) AS last,
       (SELECT JSON_OBJECT('all', count(*), 'success', sum(mr.is_success), 'minTime', min(if(mr.is_success, mr.response_time, null)), 'maxTime', max(if(mr.is_success, mr.response_time, null)), 'avgTime', avg(if(mr.is_success, mr.response_time, null))) FROM monitor_result mr WHERE mr.monitor_id = m.id) AS total
FROM monitor m 
WHERE m.id = ?
", [$id])[0] ?? null;
        if ($item) {
            $item->last = json_decode($item->last ?? 'null');
            $item->total = json_decode($item->total ?? 'null');
        }
        return $item;
    }
}
