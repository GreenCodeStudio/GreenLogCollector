<?php
namespace VisitLog\Ajax;

class VisitLogAjax extends \Core\AjaxController
{
    public function getTable($options)
    {
        $this->will('VisitLog', 'show');
        $VisitLog = new \VisitLog\VisitLog();
        return $VisitLog->getDataTable($options);
    }

    public function update($data)
    {
        $this->will('VisitLog', 'edit');
        $VisitLog = new \VisitLog\VisitLog();
        $VisitLog->update($data->id, $data);
    }
    
    public function updateMultiple(array $data)
    {      
        $this->will('VisitLog', 'edit');
        $VisitLog = new \VisitLog\VisitLog();
        foreach ($data as $row) {
            $VisitLog->update($row->id, $row->data);
        }
    }

    public function insert($data)
    {
        $this->will('VisitLog', 'add');
        $VisitLog = new \VisitLog\VisitLog();
        $id = $VisitLog->insert($data);
    }
}