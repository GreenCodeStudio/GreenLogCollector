<?php

namespace StatusPage\Controllers;

use Authorization\Permissions;
use Core\Exceptions\NotFoundException;
class StatusPageController extends \Common\PageStandardController
{

    function index()
    {
        $this->will('StatusPage', 'show');
        $this->addView('StatusPage', 'StatusPageList');
        $this->pushBreadcrumb(['title' => 'StatusPage', 'url' => '/StatusPage']);

    }

    /**
     * @param int $id
     * @OfflineDataOnly
     */
    function edit(int $id)
    {
        $this->will('StatusPage', 'edit');
        $this->addView('StatusPage', 'StatusPageEdit', ['type' => 'edit']);
        $this->pushBreadcrumb(['title' => 'StatusPage', 'url' => '/StatusPage']);
        $this->pushBreadcrumb(['title' => 'Edycja', 'url' => '/StatusPage/edit/'.$id]);
    }

    function edit_data(int $id)
    {
        $this->will('StatusPage', 'edit');
        $StatusPage = new \StatusPage\StatusPage();
        $data = $StatusPage->getById($id);
        if ($data == null)
            throw new NotFoundException();
        return ['StatusPage' => $data];
    }

    /**
     * @OfflineConstant
     */
    function add()
    {
        $this->will('StatusPage', 'add');
        $this->addView('StatusPage', 'StatusPageEdit', ['type' => 'add']);
        $this->pushBreadcrumb(['title' => 'StatusPage', 'url' => '/StatusPage']);
        $this->pushBreadcrumb(['title' => 'Dodaj', 'url' => '/StatusPage/add']);
    }
    
    
        /**
     * @param int $id
     */
    function show(int $id)
    {
        $this->will('StatusPage', 'show');
                $StatusPage = new \StatusPage\StatusPage();
        $data = $StatusPage->getById($id);
        if ($data == null)
            throw new NotFoundException();
            
        $this->addView('StatusPage', 'StatusPageShow', ['item' => $data]);
        $this->pushBreadcrumb(['title' => 'StatusPage', 'url' => '/StatusPage']);
        $this->pushBreadcrumb(['title' => 'Szczegóły', 'url' => '/StatusPage/show/'.$id]);
    }
}
