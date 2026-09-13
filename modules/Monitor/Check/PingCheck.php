<?php

namespace Monitor\Check;

class PingCheck implements ICheck
{
    public function check(string $address): array
    {
        $protocolNumber = getprotobyname('icmp');
        $socket = socket_create(AF_INET, SOCK_RAW, $protocolNumber);
        socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array('sec' => 1, 'usec' => 0));
        socket_connect($socket, $address, 0);
        $package = "\x08\x00\x19\x2f\x00\x00\x00\x00\x70\x69\x6e\x67";
        socket_send($socket, $package, strlen($package), 0);
        $readed = socket_read($socket, 255);
        socket_close($socket);
        return ['isSuccess' => (bool)$readed];
    }
}
