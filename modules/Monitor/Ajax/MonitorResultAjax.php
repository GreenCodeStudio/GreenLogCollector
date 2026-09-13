<?php
namespace Monitor\Ajax;

class MonitorResultAjax extends \Core\AjaxController
{
    public function getTable($options)
    {
        $this->will('MonitorResult', 'show');
        $MonitorResult = new \Monitor\MonitorResult();
        return $MonitorResult->getDataTable($options);
    }

    public function update($data)
    {
        $this->will('MonitorResult', 'edit');
        $MonitorResult = new \Monitor\MonitorResult();
        $MonitorResult->update($data->id, $data);
    }
    
    public function updateMultiple(array $data)
    {      
        $this->will('MonitorResult', 'edit');
        $MonitorResult = new \Monitor\MonitorResult();
        foreach ($data as $row) {
            $MonitorResult->update($row->id, $row->data);
        }
    }

    public function insert($data)
    {
        $this->will('MonitorResult', 'add');
        $MonitorResult = new \Monitor\MonitorResult();
        $id = $MonitorResult->insert($data);
    }
}