<?php
namespace ExtraLog;

use ExtraLog\Repository\ExtraLogRepository;
use Project\Repository\ProjectRepository;

class ExtraLog extends \Core\BussinesLogic
{
    public function __construct()
    {
        $this->defaultDB = new ExtraLogRepository();
    }

    public function getDataTable($options)
    {
        return $this->defaultDB->getDataTable($options);
    }

    public function update(int $id, $data)
    {
        $filtered = $this->filterData($data);
        $this->defaultDB->update($id, $filtered);
        \Core\WebSocket\Sender::sendToUsers(["ExtraLog", "ExtraLog", "Update", $id]);
    }

    protected function filterData($data)
    {
        $ret = [];
$ret['pageOpenIdentifier'] = empty($data->pageOpenIdentifier)?null:$data->pageOpenIdentifier;
$ret['source'] = empty($data->source)?null:$data->source;
$ret['type'] = empty($data->type)?null:$data->type;
$ret['data'] = empty($data->data)?null:$data->data;
        $ret['created'] = empty($data->created) ? null : $data->created;
        $ret['added'] = date('Y-m-d H:i:s');

        return $ret;
    }

    public function insert($data):int
    {
        $filtered = $this->filterData($data);

        $projectId = (new ProjectRepository())->getIdByKey($data->projectKey ?? null);
        $filtered['project_id'] = $projectId;
        $id = $this->defaultDB->insert($filtered);
        \Core\WebSocket\Sender::sendToUsers(["ExtraLog", "ExtraLog", "Insert", $id]);
        return $id;
    }
    public function getAll()
    {
        return $this->defaultDB->getAll();
    }

    public function getSelects(){
        $ret=[];
        return $ret;
    }
}
