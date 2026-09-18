<?php

namespace StatusPage\Controllers;

use Core\Exceptions\NotFoundException;
use StatusPage\StatusPage;

class PublicController extends \Common\PageStandardController
{
    public function index($code)
    {
        $statusPage = (new StatusPage())->getForPublicView($code);
        if ($statusPage == null)
            throw new NotFoundException();
        $this->pushBreadcrumb(['title' => $statusPage->name]);
        $this->addView('StatusPage', 'PublicStatusPage', ['item' => $statusPage, 'formatStatusRatio'=>fn($x)=>number_format($x*100, 2)]);
    }
    public function hasPermission(string $methodName)
    {
        return true;
    }
    public function postAction()
    {
        require __DIR__.'/../Views/publicTemplate.php';

    }
}
