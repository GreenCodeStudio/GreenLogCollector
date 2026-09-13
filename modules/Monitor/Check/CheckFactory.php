<?php

namespace Monitor\Check;

class CheckFactory
{
    public static function getChecker(string $type): ?ICheck
    {
        if ($type == "ping") {
            return new PingCheck();
        } else {
            return null;
        }
    }
}
