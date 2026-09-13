<?php
namespace StatusPage\Ajax;

class StatusPageAjax extends \Core\AjaxController
{
    public function getTable($options)
    {
        $this->will('StatusPage', 'show');
        $StatusPage = new \StatusPage\StatusPage();
        return $StatusPage->getDataTable($options);
    }

    public function update($data)
    {
        $this->will('StatusPage', 'edit');
        $StatusPage = new \StatusPage\StatusPage();
        $StatusPage->update($data->id, $data);
    }
    
    public function updateMultiple(array $data)
    {      
        $this->will('StatusPage', 'edit');
        $StatusPage = new \StatusPage\StatusPage();
        foreach ($data as $row) {
            $StatusPage->update($row->id, $row->data);
        }
    }

    public function insert($data)
    {
        $this->will('StatusPage', 'add');
        $StatusPage = new \StatusPage\StatusPage();
        $id = $StatusPage->insert($data);
    }
}