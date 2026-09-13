<?php
namespace Monitor\AsyncJobs;
use Monitor\Monitor;

class MonitorJobs extends \Core\AsyncJobController{
    /**
     * @ScheduleJob('interval'=>60)
     */
    function check()
    {
        (new Monitor())->check();
    }
}
