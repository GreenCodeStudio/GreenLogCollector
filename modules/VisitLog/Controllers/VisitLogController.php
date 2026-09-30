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

    function show(int $id)
    {
        $this->will('VisitLog', 'show');
                $VisitLog = new \VisitLog\VisitLog();
        $data = $VisitLog->getById($id);
        dump($data);
        if ($data == null)
            throw new NotFoundException();

        $this->addView('VisitLog', 'VisitLogShow', ['item' => $data]);
        $this->pushBreadcrumb(['title' => 'VisitLog', 'url' => '/VisitLog']);
        $this->pushBreadcrumb(['title' => 'Szczegóły', 'url' => '/VisitLog/show/'.$id]);
    }
}
