<?php
namespace Monitor;

use Monitor\Repository\MonitorResultRepository;

class MonitorResult extends \Core\BussinesLogic
{
    public function __construct()
    {
        $this->defaultDB = new MonitorResultRepository();
    }

    public function getDataTable($options)
    {
        return $this->defaultDB->getDataTable($options);
    }

    public function update(int $id, $data)
    {
        $filtered = $this->filterData($data);
        $this->defaultDB->update($id, $filtered);
        \Core\WebSocket\Sender::sendToUsers(["Monitor", "MonitorResult", "Update", $id]);
    }

    protected function filterData($data)
    {
        $ret = [];
        $ret['monitor_id'] = $data->monitor_id;
$ret['stamp'] = $data->stamp;
$ret['responseTime'] = empty($data->responseTime)?null:$data->responseTime;
$ret['isSuccess'] = empty($data->isSuccess)?null:$data->isSuccess;
$ret['status'] = empty($data->status)?null:$data->status;

        return $ret;
    }

    public function insert($data):int
    {
        $filtered = $this->filterData($data);
        
        $id = $this->defaultDB->insert($filtered);
        \Core\WebSocket\Sender::sendToUsers(["Monitor", "MonitorResult", "Insert", $id]);
        return $id;
    }
    public function getAll()
    {
        return $this->defaultDB->getAll();
    }
    
    public function getSelects(){
        $ret=[];
                $monitor = new Repository\monitorRepository();
        $ret["monitor"] = $monitor->getSelect();
        return $ret;
    }
}
