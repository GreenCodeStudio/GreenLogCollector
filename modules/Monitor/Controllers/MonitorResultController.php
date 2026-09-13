<?php

namespace Monitor\Controllers;

use Authorization\Permissions;
use Core\Exceptions\NotFoundException;
class MonitorResultController extends \Common\PageStandardController
{

    function index()
    {
        $this->will('MonitorResult', 'show');
        $this->addView('Monitor', 'MonitorResultList');
        $this->pushBreadcrumb(['title' => 'MonitorResult', 'url' => '/MonitorResult']);

    }

    /**
     * @param int $id
     * @OfflineDataOnly
     */
    function edit(int $id)
    {
        $this->will('MonitorResult', 'edit');
        $this->addView('Monitor', 'MonitorResultEdit', ['type' => 'edit']);
        $this->pushBreadcrumb(['title' => 'MonitorResult', 'url' => '/MonitorResult']);
        $this->pushBreadcrumb(['title' => 'Edycja', 'url' => '/MonitorResult/edit/'.$id]);
    }

    function edit_data(int $id)
    {
        $this->will('MonitorResult', 'edit');
        $MonitorResult = new \Monitor\MonitorResult();
        $data = $MonitorResult->getById($id);
        if ($data == null)
            throw new NotFoundException();
        return ['MonitorResult' => $data,'selects'=>$MonitorResult->getSelects()];
    }

    /**
     * @OfflineConstant
     */
    function add()
    {
        $this->will('MonitorResult', 'add');
        $this->addView('Monitor', 'MonitorResultEdit', ['type' => 'add']);
        $this->pushBreadcrumb(['title' => 'MonitorResult', 'url' => '/MonitorResult']);
        $this->pushBreadcrumb(['title' => 'Dodaj', 'url' => '/MonitorResult/add']);
    }
    function add_data()
    {
        $this->will('MonitorResult', 'add');
        $MonitorResult = new \Monitor\MonitorResult();
        return ['selects' => $MonitorResult->getSelects()];
    }
    
        /**
     * @param int $id
     */
    function show(int $id)
    {
        $this->will('MonitorResult', 'show');
                $MonitorResult = new \Monitor\MonitorResult();
        $data = $MonitorResult->getById($id);
        if ($data == null)
            throw new NotFoundException();
            
        $this->addView('Monitor', 'MonitorResultShow', ['item' => $data]);
        $this->pushBreadcrumb(['title' => 'MonitorResult', 'url' => '/MonitorResult']);
        $this->pushBreadcrumb(['title' => 'Szczegóły', 'url' => '/MonitorResult/show/'.$id]);
    }
}
