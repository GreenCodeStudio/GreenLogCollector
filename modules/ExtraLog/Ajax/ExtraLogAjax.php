<?php
namespace ExtraLog\Ajax;

class ExtraLogAjax extends \Core\AjaxController
{
    public function getTable($options)
    {
        $this->will('ExtraLog', 'show');
        $ExtraLog = new \ExtraLog\ExtraLog();
        return $ExtraLog->getDataTable($options);
    }

}
