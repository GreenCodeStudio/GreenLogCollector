<?php

namespace Monitor\Check;

interface ICheck
{
    public function check(string $address):array;
}
