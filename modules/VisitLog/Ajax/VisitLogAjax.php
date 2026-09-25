<?php
namespace VisitLog\Ajax;

class VisitLogAjax extends \Core\AjaxController
{
    public function getTable($options)
    {
        $this->will('VisitLog', 'show');
        $VisitLog = new \VisitLog\VisitLog();
        return $VisitLog->getDataTable($options);
    }
}
