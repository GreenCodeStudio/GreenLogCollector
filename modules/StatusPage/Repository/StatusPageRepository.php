<?php

namespace StatusPage\Repository;

use Core\Database\DB;
use Exception;


class StatusPageRepository extends \Core\Repository
{

    public function __construct()
    {
        $this->archiveMode = static::ArchiveMode_OnlyExisting;
    }

    public function defaultTable(): string
    {
        return 'status_page';
    }

    public function getDataTable($options)
    {
        $start = (int)$options->start;
        $limit = (int)$options->limit;
        $sqlOrder = $this->getOrderSQL($options);
        $rows = DB::get("SELECT * FROM status_page $sqlOrder LIMIT $start,$limit");
        $total = DB::get("SELECT count(*) as count FROM status_page")[0]->count;
        return ['rows' => $rows, 'total' => $total];
    }

    private function getOrderSQL($options)
    {
        if (empty($options->sort))
            return "";
        else {
            $mapping = [];
            if (empty($mapping[$options->sort->col]))
                throw new Exception();
            return ' ORDER BY '.DB::safeKey($mapping[$options->sort->col]).' '.($options->sort->desc ? 'DESC' : 'ASC').' ';
        }
    }

    public function getAll()
    {
        if ($this->archiveMode == static::ArchiveMode_OnlyExisting)
            return DB::get("SELECT * FROM status_page WHERE is_archived = 0");
        else
            return DB::get("SELECT * FROM status_page");
    }

    public function getForPublicView($code)
    {
        $item = DB::get("SELECT * FROM status_page WHERE code = ?", [$code])[0] ?? null;
        if (!empty($item)) {
            $item->monitors = DB::get("SELECT m.*,
       (
       SELECT JSON_OBJECT('stamp', mr.stamp, 'responseTime', mr.responseTime, 'isSuccess', mr.isSuccess, 'status', mr.status) 
        FROM monitor_result mr 
        WHERE mr.monitor_id = m.id 
        ORDER BY stamp DESC
           LIMIT 1
        ) AS last,
(SELECT JSON_ARRAYAGG(JSON_OBJECT('stamp',mr.stamp, 'isSuccess', mr.isSuccess)) FROM monitor_result mr 
        WHERE mr.monitor_id = m.id AND stamp >= DATE_SUB(NOW(), INTERVAL 31 DAY)
        ORDER BY stamp DESC
        ) AS results
FROM status_page_monitor spm JOIN monitor m ON spm.monitor_id=m.id WHERE spm.statusPage_id = ?", [$item->id]);
            foreach ($item->monitors as $monitor) {
                $monitor->last = json_decode($monitor->last ?? 'null');
                $monitor->results = json_decode($monitor->results ?? '[]');
            }
        }
        return $item;
    }
}
