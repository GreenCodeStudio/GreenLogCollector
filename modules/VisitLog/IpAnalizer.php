<?php

namespace VisitLog;

class IpAnalizer
{
    public function isBot($ip)
    {
        if (preg_match('/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/', $ip)) {
            $ipLong = ip2long($ip);
            foreach ([...(array)$this->getCrawlers()->services, ...(array)$this->getMonitoring()->services] as $serviceInfo) {
                foreach ($serviceInfo->ipv4 as $ipRange) {
                    [$base, $mask] = explode('/', $ipRange);
                    $baseLong = ip2long($base);
                    $maskLong = ~((1 << (32 - (int)$mask)) - 1);
                    if (($ipLong & $maskLong) === ($baseLong & $maskLong)) {
                        return $serviceInfo;
                    }
                }
            }
        }
        //todo ipv6
        return false;
    }

    public function isAbusive($ip)
    {
        $list=$this->getIpsum();
        foreach ($list as $blacklistedIp) {
            if(str_starts_with($blacklistedIp, $ip)) {
                [$ip, $count] = explode("\t", $blacklistedIp);
                return (int)$count;
            }
        }
        return 0;
    }

    public function getCrawlers(bool $forceUpdate = false)
    {
        $tmpFile = __DIR__.'/../../tmp/crawlers.json';
        $webFile = 'https://raw.githubusercontent.com/ipverse/bot-ip-blocks/master/crawlers.json';
        if (!file_exists($tmpFile) || $forceUpdate) {
            $data = json_decode(file_get_contents($webFile));
            file_put_contents($tmpFile, json_encode($data));
            return $data;
        } else {
            return json_decode(file_get_contents($tmpFile));
        }
    }
    public function getIpsum(bool $forceUpdate = false)
{
    $tmpFile = __DIR__.'/../../tmp/ipsum.txt';
    $webFile = 'https://raw.githubusercontent.com/stamparm/ipsum/master/ipsum.txt';
    if (!file_exists($tmpFile) || $forceUpdate) {
        $data = file_get_contents($webFile);
        file_put_contents($tmpFile, $data);
        return explode("\n", $data);
    } else {
        return explode("\n", file_get_contents($tmpFile));
    }
}

    public function getMonitoring(bool $forceUpdate = false)
    {
        $tmpFile = __DIR__.'/../../tmp/crawlers.json';
        $webFile = 'https://raw.githubusercontent.com/ipverse/bot-ip-blocks/master/monitoring.json';
        if (!file_exists($tmpFile) || $forceUpdate) {
            $data = json_decode(file_get_contents($webFile));
            file_put_contents($tmpFile, json_encode($data));
            return $data;
        } else {
            return json_decode(file_get_contents($tmpFile));
        }
    }
}
