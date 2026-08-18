<?php
namespace Project\Ajax;

class ProjectAjax extends \Core\AjaxController
{
    public function getTable($options)
    {
        $this->will('Project', 'show');
        $Project = new \Project\Project();
        return $Project->getDataTable($options);
    }

    public function update($data)
    {
        $this->will('Project', 'edit');
        $Project = new \Project\Project();
        $Project->update($data->id, $data);
    }
    
    public function updateMultiple(array $data)
    {      
        $this->will('Project', 'edit');
        $Project = new \Project\Project();
        foreach ($data as $row) {
            $Project->update($row->id, $row->data);
        }
    }

    public function insert($data)
    {
        $this->will('Project', 'add');
        $Project = new \Project\Project();
        $id = $Project->insert($data);
    }
}