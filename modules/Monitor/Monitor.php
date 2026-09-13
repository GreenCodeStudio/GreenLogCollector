<?php

namespace Monitor;

use Monitor\Check\CheckFactory;
use Monitor\Repository\MonitorRepository;
use Monitor\Repository\MonitorResultRepository;

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
        $ret['is_archived'] = 0;

        return $ret;
    }

    public function insert($data): int
    {
        $filtered = $this->filterData($data);

        $id = $this->defaultDB->insert($filtered);
        \Core\WebSocket\Sender::sendToUsers(["Monitor", "Monitor", "Insert", $id]);
        $this->checkMonitor($this->defaultDB->getById($id));
        return $id;
    }

    public function getAll()
    {
        return $this->defaultDB->getAll();
    }

    public function getSelects()
    {
        $ret = [];
        return $ret;
    }

    public function check()
    {
        $monitors = $this->defaultDB->getAll();
        foreach ($monitors as $monitor) {
            $this->checkMonitor($monitor);
        }
    }

    public function checkMonitor($monitor)
    {
        $resultRepository = new MonitorResultRepository();
        $result = null;
        for ($i = 0; $i < 3; $i++) {
            $start = microtime(true);
            $startDate = date('Y-m-d H:i:s');
            $result = CheckFactory::getChecker($monitor->type)->check($monitor->address);
            $end = microtime(true);
            if ($result['isSuccess'])
                break;
        }
        $resultRepository->insert([
            'monitor_id' => $monitor->id,
            'isSuccess' => $result['isSuccess'],
            'status' => json_encode($result['status'] ?? null),
            'stamp' => $startDate,
            'responseTime' => $end - $start,
        ]);
    }

    public function getToShow(int $id)
    {
        return $this->defaultDB->getToShow($id);
    }
}
