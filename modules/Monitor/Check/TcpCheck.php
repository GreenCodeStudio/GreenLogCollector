<?php

namespace Monitor\Check;

class TcpCheck implements ICheck
{
    public function check(string $address): array
    {
        $urlParts = parse_url($address);
        $host = $urlParts['host'] ?? $address;
        $port = $urlParts['port'] ?? 1;
        $tcpSocket = socket_create(AF_INET, SOCK_STREAM, 0);
        $success=socket_connect($tcpSocket, $host, $port);

        socket_close($tcpSocket);

        return [
            'isSuccess' => $success,
        ];
    }
}
