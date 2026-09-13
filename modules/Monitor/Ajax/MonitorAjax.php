<?php
namespace Monitor\Ajax;

class MonitorAjax extends \Core\AjaxController
{
    public function getTable($options)
    {
        $this->will('Monitor', 'show');
        $Monitor = new \Monitor\Monitor();
        return $Monitor->getDataTable($options);
    }

    public function update($data)
    {
        $this->will('Monitor', 'edit');
        $Monitor = new \Monitor\Monitor();
        $Monitor->update($data->id, $data);
    }
    
    public function updateMultiple(array $data)
    {      
        $this->will('Monitor', 'edit');
        $Monitor = new \Monitor\Monitor();
        foreach ($data as $row) {
            $Monitor->update($row->id, $row->data);
        }
    }

    public function insert($data)
    {
        $this->will('Monitor', 'add');
        $Monitor = new \Monitor\Monitor();
        $id = $Monitor->insert($data);
    }
}