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
                        return true;
                    }
                }
            }
        }
        //todo ipv6
        return false;
    }

    public function isAbuseIpDbBlacklisted($ip)
    {
        $abuseipdbBlacklist = explode("\n", file_get_contents(__DIR__.'/abuseipdb_blacklist.csv'));
        return in_array($ip, $abuseipdbBlacklist);
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
