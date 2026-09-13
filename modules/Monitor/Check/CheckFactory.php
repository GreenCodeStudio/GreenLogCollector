<?php

namespace Monitor\Check;

class CheckFactory
{
    public static function getChecker(string $type): ?ICheck
    {
        if ($type == "ping") {
            return new PingCheck();
        } else if ($type == "http") {
            return new HttpCheck();
        } else {
            return null;
        }
    }
}
