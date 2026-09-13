<?php
namespace StatusPage;

use StatusPage\Repository\StatusPageRepository;

class StatusPage extends \Core\BussinesLogic
{
    public function __construct()
    {
        $this->defaultDB = new StatusPageRepository();
    }

    public function getDataTable($options)
    {
        return $this->defaultDB->getDataTable($options);
    }

    public function update(int $id, $data)
    {
        $filtered = $this->filterData($data);
        $this->defaultDB->update($id, $filtered);
        \Core\WebSocket\Sender::sendToUsers(["StatusPage", "StatusPage", "Update", $id]);
    }

    protected function filterData($data)
    {
        $ret = [];

        return $ret;
    }

    public function insert($data):int
    {
        $filtered = $this->filterData($data);

        $id = $this->defaultDB->insert($filtered);
        \Core\WebSocket\Sender::sendToUsers(["StatusPage", "StatusPage", "Insert", $id]);
        return $id;
    }
    public function getAll()
    {
        return $this->defaultDB->getAll();
    }

    public function getForPublicView($code)
    {
        return $this->defaultDB->getForPublicView($code);
    }


}
