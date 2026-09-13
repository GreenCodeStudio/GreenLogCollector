<?php

namespace Monitor\Check;

class PingCheck implements ICheck
{
    public function check(string $address): array
    {
        return ['isSuccess' => true];
    }
}
