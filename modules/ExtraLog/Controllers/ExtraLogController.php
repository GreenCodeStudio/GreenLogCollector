<?php

namespace ExtraLog\Controllers;

use Authorization\Permissions;
use Core\Exceptions\NotFoundException;
class ExtraLogController extends \Common\PageStandardController
{

    function index()
    {
        $this->will('ExtraLog', 'show');
        $this->addView('ExtraLog', 'ExtraLogList');
        $this->pushBreadcrumb(['title' => 'ExtraLog', 'url' => '/ExtraLog']);

    }

    /**
     * @param int $id
     * @OfflineDataOnly
     */
    function edit(int $id)
    {
        $this->will('ExtraLog', 'edit');
        $this->addView('ExtraLog', 'ExtraLogEdit', ['type' => 'edit']);
        $this->pushBreadcrumb(['title' => 'ExtraLog', 'url' => '/ExtraLog']);
        $this->pushBreadcrumb(['title' => 'Edycja', 'url' => '/ExtraLog/edit/'.$id]);
    }

    function edit_data(int $id)
    {
        $this->will('ExtraLog', 'edit');
        $ExtraLog = new \ExtraLog\ExtraLog();
        $data = $ExtraLog->getById($id);
        if ($data == null)
            throw new NotFoundException();
        return ['ExtraLog' => $data,'selects'=>$ExtraLog->getSelects()];
    }

    /**
     * @OfflineConstant
     */
    function add()
    {
        $this->will('ExtraLog', 'add');
        $this->addView('ExtraLog', 'ExtraLogEdit', ['type' => 'add']);
        $this->pushBreadcrumb(['title' => 'ExtraLog', 'url' => '/ExtraLog']);
        $this->pushBreadcrumb(['title' => 'Dodaj', 'url' => '/ExtraLog/add']);
    }
    function add_data()
    {
        $this->will('ExtraLog', 'add');
        $ExtraLog = new \ExtraLog\ExtraLog();
        return ['selects' => $ExtraLog->getSelects()];
    }
    
        /**
     * @param int $id
     */
    function show(int $id)
    {
        $this->will('ExtraLog', 'show');
                $ExtraLog = new \ExtraLog\ExtraLog();
        $data = $ExtraLog->getById($id);
        if ($data == null)
            throw new NotFoundException();
            
        $this->addView('ExtraLog', 'ExtraLogShow', ['item' => $data]);
        $this->pushBreadcrumb(['title' => 'ExtraLog', 'url' => '/ExtraLog']);
        $this->pushBreadcrumb(['title' => 'Szczegóły', 'url' => '/ExtraLog/show/'.$id]);
    }
}
