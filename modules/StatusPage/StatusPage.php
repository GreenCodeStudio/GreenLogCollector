<?php

namespace StatusPage;

use StatusPage\Repository\StatusPageRepository;

class StatusPage extends \Core\BussinesLogic
{
    public function __construct()
    {
        $this->defaultDB = new StatusPageRepository();
    }

    public function getDataTable($options)
    {
        return $this->defaultDB->getDataTable($options);
    }

    public function update(int $id, $data)
    {
        $filtered = $this->filterData($data);
        $this->defaultDB->update($id, $filtered);
        \Core\WebSocket\Sender::sendToUsers(["StatusPage", "StatusPage", "Update", $id]);
    }

    protected function filterData($data)
    {
        $ret = [];

        return $ret;
    }

    public function insert($data): int
    {
        $filtered = $this->filterData($data);

        $id = $this->defaultDB->insert($filtered);
        \Core\WebSocket\Sender::sendToUsers(["StatusPage", "StatusPage", "Insert", $id]);
        return $id;
    }

    public function getAll()
    {
        return $this->defaultDB->getAll();
    }

    public function getForPublicView($code)
    {
        $list = $this->defaultDB->getForPublicView($code);
        $okTime=0;
        $failTime=0;
        foreach ($list->monitors as $item) {
            $ranges = [];
            $now = time();
            $last = null;
            foreach ($item->results as $result) {
                $stamp = strtotime($result->stamp);
                if ($last === null || $last->isSuccess != $result->isSuccess) {
                    if ($last !== null) {
                        $ranges[] = [
                            'start' => strtotime($last->stamp) - $now,
                            'end' => $stamp - $now,
                            'isSuccess' => $last->isSuccess,
                            'title' => ($last->isSuccess ? t('StatusPage.statusPage.ok') : t('StatusPage.statusPage.fail')).' '.t('StatusPage.statusPage.from').' '.date('Y-m-d H:i:s', strtotime($last->stamp)).' '.t('StatusPage.statusPage.to').' '.date('Y-m-d H:i:s', $stamp),
                        ];
                        if ($last->isSuccess) {
                            $okTime += $stamp - strtotime($last->stamp);
                        } else {
                            $failTime += $stamp - strtotime($last->stamp);
                        }
                    }
                    $last = $result;
                }
            }
            if ($last !== null) {
                $ranges[] = [
                    'start' => strtotime($last->stamp) - $now,
                    'end' => $stamp - $now,
                    'isSuccess' => $last->isSuccess,
                    'title' => ($last->isSuccess ? t('StatusPage.statusPage.ok') : t('StatusPage.statusPage.fail')).' '.t('StatusPage.statusPage.from').' '.date('Y-m-d H:i:s', strtotime($last->stamp)).' '.t('StatusPage.statusPage.to').' '.date('Y-m-d H:i:s', $stamp),
                ];
                if ($last->isSuccess) {
                    $okTime += $stamp - strtotime($last->stamp);
                } else {
                    $failTime += $stamp - strtotime($last->stamp);
                }
            }
            $item->ranges = $ranges;
            $item->successRatio = $okTime / ($okTime + $failTime);
            unset ($item->results);
        }
        return $list;
    }


}
