<?php

namespace Common;

class PageStandardController extends \Core\StandardController
{
    use \CommonBase\PageStandardControllerTrait;
    public function getPageTitle(): string
    {
        return "Green Log Collector";
    }
}

