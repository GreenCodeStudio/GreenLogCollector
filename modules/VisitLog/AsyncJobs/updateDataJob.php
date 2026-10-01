<?php
namespace Authorization\AsyncJobs;
class updateDataJob extends \Core\AsyncJobController{
    /**
     * @ScheduleJob('interval'=>3600)
     */
    function refreshBotIpsData()
    {
        (new \Authorization\Authorization())->refreshUserData();
    }
}
