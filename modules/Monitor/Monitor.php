<?php

namespace Monitor;

use Monitor\Check\CheckFactory;
use Monitor\Repository\MonitorRepository;

class Monitor extends \Core\BussinesLogic
{
    public function __construct()
    {
        $this->defaultDB = new MonitorRepository();
    }

    public function getDataTable($options)
    {
        return $this->defaultDB->getDataTable($options);
    }

    public function update(int $id, $data)
    {
        $filtered = $this->filterData($data);
        $this->defaultDB->update($id, $filtered);
        \Core\WebSocket\Sender::sendToUsers(["Monitor", "Monitor", "Update", $id]);
    }

    protected function filterData($data)
    {
        $ret = [];
        $ret['name'] = empty($data->name) ? null : $data->name;
        $ret['address'] = empty($data->address) ? null : $data->address;
        $ret['type'] = $data->type;
        $ret['project_id'] = empty($data->project_id) ? null : $data->project_id;

        return $ret;
    }

    public function insert($data): int
    {
        $filtered = $this->filterData($data);

        $id = $this->defaultDB->insert($filtered);
        \Core\WebSocket\Sender::sendToUsers(["Monitor", "Monitor", "Insert", $id]);
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

    public function check()
    {
        $monitors = $this->defaultDB->getAll();
        foreach ($monitors as $monitor) {
            $result = CheckFactory::getChecker($monitor->type)->check($monitor->address);
            dump($result);
            
        }
    }
}
