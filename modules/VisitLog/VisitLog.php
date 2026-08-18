<?php

namespace VisitLog;

use Project\Repository\ProjectRepository;
use VisitLog\Repository\VisitLogRepository;

class VisitLog extends \Core\BussinesLogic
{
    public function __construct()
    {
        $this->defaultDB = new VisitLogRepository();
    }

    public function getDataTable($options)
    {
        return $this->defaultDB->getDataTable($options);
    }

    public function update(int $id, $data)
    {
        $filtered = $this->filterData($data);
        $this->defaultDB->update($id, $filtered);
        \Core\WebSocket\Sender::sendToUsers(["VisitLog", "VisitLog", "Update", $id]);
    }

    protected function filterData($data)
    {
        $ret = [];
        $ret['userIdentifier'] = empty($data->userIdentifier) ? null : $data->userIdentifier;
        $ret['userAgent'] = empty($data->userAgent) ? null : $data->userAgent;
        $ret['ipAddress'] = empty($data->ipAddress) ? null : $data->ipAddress;
        $ret['sessionIdentifier'] = empty($data->sessionIdentifier) ? null : $data->sessionIdentifier;
        $ret['pageOpenIdentifier'] = empty($data->pageOpenIdentifier) ? null : $data->pageOpenIdentifier;
        $ret['url'] = empty($data->url) ? null : $data->url;
        $ret['added'] = date('Y-m-d H:i:s');
        $ret['type'] = empty($data->type) ? null : $data->type;
        $ret['created'] = empty($data->created) ? null : $data->created;

        return $ret;
    }

    public function insert($data): int
    {
        $filtered = $this->filterData($data);

        $projectId = (new ProjectRepository())->getIdByKey($data->projectKey ?? null);
        $filtered['project_id'] = $projectId;
        $id = $this->defaultDB->insert($filtered);
        \Core\WebSocket\Sender::sendToUsers(["VisitLog", "VisitLog", "Insert", $id]);
        return $id;
    }

    public function getAll()
    {
        return $this->defaultDB->getAll();
    }

    public function getSelects()
    {
        $ret = [];
        $project = new Repository\projectRepository();
        $ret["project"] = $project->getSelect();
        return $ret;
    }
}
