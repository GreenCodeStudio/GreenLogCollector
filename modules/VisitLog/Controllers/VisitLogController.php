<?php

namespace VisitLog\Controllers;

use Authorization\Permissions;
use Core\Exceptions\NotFoundException;
use DeviceDetector\DeviceDetector;
use VisitLog\IpAnalizer;

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
        if ($data == null)
            throw new NotFoundException();
        if($data->ipAddress) {
            $data->ipAddressIsBot = (new IpAnalizer())->isBot($data->ipAddress);
            $data->ipAddressAbusive = (new IpAnalizer())->isAbusive($data->ipAddress);
        }

        dump($data);
        $links = [
            'project_id' => '/VisitLog?columnFilters='.urlencode(json_encode([["project_id", ["type" => "equals", "value" => $data->project_id]]])),
            'userIdentifier' => '/VisitLog?columnFilters='.urlencode(json_encode([["userIdentifier", ["type" => "equals", "value" => $data->userIdentifier]]])),
            'userAgent' => '/VisitLog?columnFilters='.urlencode(json_encode([["userAgent", ["type" => "equals", "value" => $data->userAgent]]])),
            'ipAddress' => '/VisitLog?columnFilters='.urlencode(json_encode([["ipAddress", ["type" => "equals", "value" => $data->ipAddress]]])),
            'sessionIdentifier' => '/VisitLog?columnFilters='.urlencode(json_encode([["sessionIdentifier", ["type" => "equals", "value" => $data->sessionIdentifier]]])),
            'pageOpenIdentifier' => '/VisitLog?columnFilters='.urlencode(json_encode([["pageOpenIdentifier", ["type" => "equals", "value" => $data->pageOpenIdentifier]]])),
            'url' => '/VisitLog?columnFilters='.urlencode(json_encode([["url", ["type" => "equals", "value" => $data->url]]])),
        ];
        $this->addView('VisitLog', 'VisitLogShow', ['item' => $data, 'links' => $links]);
        $this->pushBreadcrumb(['title' => 'VisitLog', 'url' => '/VisitLog']);
        $this->pushBreadcrumb(['title' => 'Szczegóły', 'url' => '/VisitLog/show/'.$id]);
    }
}
