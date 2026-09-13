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
        $rows = DB::get("SELECT m.*, (SELECT isSuccess FROM monitor_result mr WHERE mr.monitor_id = m.id ORDER BY stamp DESC LIMIT 1) as isSuccess FROM monitor m $sqlOrder LIMIT $start,$limit");
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
       (SELECT JSON_OBJECT('stamp', mr.stamp, 'responseTime', mr.responseTime, 'isSuccess', mr.isSuccess, 'status', mr.status) FROM monitor_result mr WHERE mr.monitor_id = m.id ORDER BY stamp DESC LIMIT 1) AS last,
       (SELECT JSON_OBJECT('all', count(*), 'success', sum(mr.isSuccess), 'minTime', min(if(mr.isSuccess, mr.responseTime, null)), 'maxTime', max(if(mr.isSuccess, mr.responseTime, null)), 'avgTime', avg(if(mr.isSuccess, mr.responseTime, null))) FROM monitor_result mr WHERE mr.monitor_id = m.id AND mr.stamp > SUBDATE(NOW(), INTERVAL 1 WEEK)) AS week,
       (SELECT JSON_OBJECT('all', count(*), 'success', sum(mr.isSuccess), 'minTime', min(if(mr.isSuccess, mr.responseTime, null)), 'maxTime', max(if(mr.isSuccess, mr.responseTime, null)), 'avgTime', avg(if(mr.isSuccess, mr.responseTime, null))) FROM monitor_result mr WHERE mr.monitor_id = m.id AND mr.stamp > SUBDATE(NOW(), INTERVAL 1 YEAR)) AS `year`,
       (SELECT JSON_OBJECT('all', count(*), 'success', sum(mr.isSuccess), 'minTime', min(if(mr.isSuccess, mr.responseTime, null)), 'maxTime', max(if(mr.isSuccess, mr.responseTime, null)), 'avgTime', avg(if(mr.isSuccess, mr.responseTime, null))) FROM monitor_result mr WHERE mr.monitor_id = m.id) AS total
FROM monitor m 
WHERE m.id = ?
", [$id])[0] ?? null;
        if ($item) {
            $item->last = json_decode($item->last ?? 'null');
            $item->total = json_decode($item->total ?? 'null');
            $item->week = json_decode($item->week ?? 'null');
            $item->year = json_decode($item->year ?? 'null');
        }
        return $item;
    }
}
