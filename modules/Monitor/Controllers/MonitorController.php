<?php

namespace Monitor\Controllers;

use Authorization\Permissions;
use Core\Exceptions\NotFoundException;
use Core\Formatter;

class MonitorController extends \Common\PageStandardController
{

    function index()
    {
        $this->will('Monitor', 'show');
        $this->addView('Monitor', 'MonitorList');
        $this->pushBreadcrumb(['title' => 'Monitor', 'url' => '/Monitor']);

    }

    /**
     * @param int $id
     * @OfflineDataOnly
     */
    function edit(int $id)
    {
        $this->will('Monitor', 'edit');
        $this->addView('Monitor', 'MonitorEdit', ['type' => 'edit']);
        $this->pushBreadcrumb(['title' => 'Monitor', 'url' => '/Monitor']);
        $this->pushBreadcrumb(['title' => 'Edycja', 'url' => '/Monitor/edit/'.$id]);
    }

    function edit_data(int $id)
    {
        $this->will('Monitor', 'edit');
        $Monitor = new \Monitor\Monitor();
        $data = $Monitor->getById($id);
        if ($data == null)
            throw new NotFoundException();
        return ['Monitor' => $data,'selects'=>$Monitor->getSelects()];
    }

    /**
     * @OfflineConstant
     */
    function add()
    {
        $this->will('Monitor', 'add');
        $this->addView('Monitor', 'MonitorEdit', ['type' => 'add']);
        $this->pushBreadcrumb(['title' => 'Monitor', 'url' => '/Monitor']);
        $this->pushBreadcrumb(['title' => 'Dodaj', 'url' => '/Monitor/add']);
    }
    function add_data()
    {
        $this->will('Monitor', 'add');
        $Monitor = new \Monitor\Monitor();
        return ['selects' => $Monitor->getSelects()];
    }

        /**
     * @param int $id
     */
    function show(int $id)
    {
        $this->will('Monitor', 'show');
                $Monitor = new \Monitor\Monitor();
        $data = $Monitor->getToShow($id);
        if ($data == null)
            throw new NotFoundException();
        dump($data);

        $this->addView('Monitor', 'MonitorShow', ['item' => $data, 'formatSeconds'=>fn($x)=>Formatter::formatSeconds($x), 'formatDate'=>fn($x)=>Formatter::formatDate($x)]);
        $this->pushBreadcrumb(['title' => 'Monitor', 'url' => '/Monitor']);
        $this->pushBreadcrumb(['title' => 'Szczegóły', 'url' => '/Monitor/show/'.$id]);
    }
}
