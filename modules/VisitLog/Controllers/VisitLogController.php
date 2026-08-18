<?php

namespace VisitLog\Controllers;

use Authorization\Permissions;
use Core\Exceptions\NotFoundException;
class VisitLogController extends \Common\PageStandardController
{

    function index()
    {
        $this->will('VisitLog', 'show');
        $this->addView('VisitLog', 'VisitLogList');
        $this->pushBreadcrumb(['title' => 'VisitLog', 'url' => '/VisitLog']);

    }

    /**
     * @param int $id
     * @OfflineDataOnly
     */
    function edit(int $id)
    {
        $this->will('VisitLog', 'edit');
        $this->addView('VisitLog', 'VisitLogEdit', ['type' => 'edit']);
        $this->pushBreadcrumb(['title' => 'VisitLog', 'url' => '/VisitLog']);
        $this->pushBreadcrumb(['title' => 'Edycja', 'url' => '/VisitLog/edit/'.$id]);
    }

    function edit_data(int $id)
    {
        $this->will('VisitLog', 'edit');
        $VisitLog = new \VisitLog\VisitLog();
        $data = $VisitLog->getById($id);
        if ($data == null)
            throw new NotFoundException();
        return ['VisitLog' => $data,'selects'=>$VisitLog->getSelects()];
    }

    /**
     * @OfflineConstant
     */
    function add()
    {
        $this->will('VisitLog', 'add');
        $this->addView('VisitLog', 'VisitLogEdit', ['type' => 'add']);
        $this->pushBreadcrumb(['title' => 'VisitLog', 'url' => '/VisitLog']);
        $this->pushBreadcrumb(['title' => 'Dodaj', 'url' => '/VisitLog/add']);
    }
    function add_data()
    {
        $this->will('VisitLog', 'add');
        $VisitLog = new \VisitLog\VisitLog();
        return ['selects' => $VisitLog->getSelects()];
    }
    
        /**
     * @param int $id
     */
    function show(int $id)
    {
        $this->will('VisitLog', 'show');
                $VisitLog = new \VisitLog\VisitLog();
        $data = $VisitLog->getById($id);
        if ($data == null)
            throw new NotFoundException();
            
        $this->addView('VisitLog', 'VisitLogShow', ['item' => $data]);
        $this->pushBreadcrumb(['title' => 'VisitLog', 'url' => '/VisitLog']);
        $this->pushBreadcrumb(['title' => 'Szczegóły', 'url' => '/VisitLog/show/'.$id]);
    }
}
