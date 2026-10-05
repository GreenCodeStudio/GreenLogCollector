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

    private function datatableColumnMap()
    {
        return ['project_id' => 'project_id', 'userIdentifier' => 'userIdentifier', 'userAgent' => 'userAgent', 'ipAddress' => 'ipAddress', 'sessionIdentifier' => 'sessionIdentifier', 'pageOpenIdentifier' => 'pageOpenIdentifier', 'url' => 'url', 'created' => 'created', 'added' => 'added', 'type' => 'type', 'botProbability' => 'botProbability'];

    }

    public function getDataTable($options)
    {
        $sqlParams = [];
        $filterSql = $this->generateColumnFilterSql($options->columnFilters, $this->datatableColumnMap(), $sqlParams);
        if ($options->mode == 'summary') {
            $summary = DB::get("SELECT date(created) as date, count(*) as count FROM visit_log WHERE $filterSql GROUP BY date(created )", $sqlParams);
            return ['summary' => $summary];
        } else {
            $start = (int)$options->start;
            $limit = (int)$options->limit;
            $sqlOrder = $this->getOrderSQL($options);
            $rows = DB::get("SELECT * FROM visit_log WHERE $filterSql$sqlOrder LIMIT $start,$limit", $sqlParams);
            $total = DB::get("SELECT count(*) as count FROM visit_log WHERE $filterSql", $sqlParams)[0]->count;
            return ['rows' => $rows, 'total' => $total];
        }
    }

    private function getOrderSQL($options)
    {
        if (empty($options->sort))
            return "";
        else {
            $mapping = $this->datatableColumnMap();
            if (empty($mapping[$options->sort->col]))
                throw new Exception();
            return ' ORDER BY '.DB::safeKey($mapping[$options->sort->col]).' '.($options->sort->desc ? 'DESC' : 'ASC').' ';
        }
    }

    public function getAll()
    {
        if ($this->archiveMode == static::ArchiveMode_OnlyExisting)
            return DB::get("SELECT * FROM visit_log WHERE is_archived = 0");
        else
            return DB::get("SELECT * FROM visit_log");
    }

    public function getById($id)
    {
        $item = DB::get("SELECT * FROM visit_log WHERE id = :id", ['id' => $id])[0] ?? null;
        if ($item && $item->pageOpenIdentifier) {
            $item->extraLogs = DB::get("SELECT * FROM extra_log WHERE pageOpenIdentifier = :pageOpenIdentifier AND project_id = :project_id ORDER BY created ASC", ['pageOpenIdentifier' => $item->pageOpenIdentifier, 'project_id' => $item->project_id]);
            foreach ($item->extraLogs as $log) {
                $log->data = json_decode($log->data??'null');
            }
        }else{
            $item->extraLogs=null;
        }
        return $item;
    }

    public function reduceBotProbability($project_id, $pageOpenIdentifier, float $multiplier)
    {
        DB::query("UPDATE visit_log SET botProbability = botProbability * :multiplier WHERE project_id = :project_id AND pageOpenIdentifier = :pageOpenIdentifier", ['multiplier' => $multiplier, 'project_id' => $project_id, 'pageOpenIdentifier' => $pageOpenIdentifier]);
    }
}
