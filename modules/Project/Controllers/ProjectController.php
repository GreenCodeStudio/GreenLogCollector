<?php

namespace Project\Controllers;

use Authorization\Permissions;
use Core\Exceptions\NotFoundException;
class ProjectController extends \Common\PageStandardController
{

    function index()
    {
        $this->will('Project', 'show');
        $this->addView('Project', 'ProjectList');
        $this->pushBreadcrumb(['title' => 'Project', 'url' => '/Project']);

    }

    /**
     * @param int $id
     * @OfflineDataOnly
     */
    function edit(int $id)
    {
        $this->will('Project', 'edit');
        $this->addView('Project', 'ProjectEdit', ['type' => 'edit']);
        $this->pushBreadcrumb(['title' => 'Project', 'url' => '/Project']);
        $this->pushBreadcrumb(['title' => 'Edycja', 'url' => '/Project/edit/'.$id]);
    }

    function edit_data(int $id)
    {
        $this->will('Project', 'edit');
        $Project = new \Project\Project();
        $data = $Project->getById($id);
        if ($data == null)
            throw new NotFoundException();
        return ['Project' => $data];
    }

    /**
     * @OfflineConstant
     */
    function add()
    {
        $this->will('Project', 'add');
        $this->addView('Project', 'ProjectEdit', ['type' => 'add']);
        $this->pushBreadcrumb(['title' => 'Project', 'url' => '/Project']);
        $this->pushBreadcrumb(['title' => 'Dodaj', 'url' => '/Project/add']);
    }
    
    
        /**
     * @param int $id
     */
    function show(int $id)
    {
        $this->will('Project', 'show');
                $Project = new \Project\Project();
        $data = $Project->getById($id);
        if ($data == null)
            throw new NotFoundException();
            
        $this->addView('Project', 'ProjectShow', ['item' => $data]);
        $this->pushBreadcrumb(['title' => 'Project', 'url' => '/Project']);
        $this->pushBreadcrumb(['title' => 'Szczegóły', 'url' => '/Project/show/'.$id]);
    }
}
