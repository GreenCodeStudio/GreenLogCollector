<?php
namespace Project;

use Project\Repository\ProjectRepository;

class Project extends \Core\BussinesLogic
{
    public function __construct()
    {
        $this->defaultDB = new ProjectRepository();
    }

    public function getDataTable($options)
    {
        return $this->defaultDB->getDataTable($options);
    }

    public function update(int $id, $data)
    {
        $filtered = $this->filterData($data);
        $this->defaultDB->update($id, $filtered);
        \Core\WebSocket\Sender::sendToUsers(["Project", "Project", "Update", $id]);
    }

    protected function filterData($data)
    {
        $ret = [];
        $ret['name'] = empty($data->name)?null:$data->name;

        return $ret;
    }

    public function insert($data):int
    {
        $filtered = $this->filterData($data);
        
        $id = $this->defaultDB->insert($filtered);
        \Core\WebSocket\Sender::sendToUsers(["Project", "Project", "Insert", $id]);
        return $id;
    }
    public function getAll()
    {
        return $this->defaultDB->getAll();
    }
    
    
}