<?php

namespace Project\Repository;

use Core\Database\DB;
use Exception;


class ProjectRepository extends \Core\Repository
{

    public function __construct()
    {
        $this->archiveMode = static::ArchiveMode_OnlyExisting;
    }
    public function defaultTable(): string
    {
        return 'project';
    }
    public function getDataTable($options)
    {
        $start = (int)$options->start;
        $limit = (int)$options->limit;
        $sqlOrder = $this->getOrderSQL($options);
        $rows = DB::get("SELECT * FROM project $sqlOrder LIMIT $start,$limit");
        $total = DB::get("SELECT count(*) as count FROM project")[0]->count;
        return ['rows' => $rows, 'total' => $total];
    }
        private function getOrderSQL($options)
    {
        if (empty($options->sort))
            return "";
        else {
            $mapping = ['name'=> 'name'];
            if (empty($mapping[$options->sort->col]))
                throw new Exception();
            return ' ORDER BY '.DB::safeKey($mapping[$options->sort->col]).' '.($options->sort->desc ? 'DESC' : 'ASC').' ';
        }
    }    public function getAll()
    {
        if($this->archiveMode == static::ArchiveMode_OnlyExisting)
            return DB::get("SELECT * FROM project WHERE is_archived = 0");
        else
            return DB::get("SELECT * FROM project");
    }

    public function getIdByKey($projectKey)
    {
        return DB::get("SELECT project_id FROM project_key WHERE `key` = ?", [$projectKey])[0]->project_id;
    }
}
