<?php

namespace Monitor\Check;

class HttpCheck implements ICheck
{
    public function check(string $address): array
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $address);
        curl_setopt($curl, CURLOPT_HTTPGET, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 GreenLogCollector https://greenlogcollector.green-code.studio/');

        curl_exec($curl);
        $statusCode = (int)curl_getinfo($curl, CURLINFO_RESPONSE_CODE);
        curl_close($curl);

        return [
            'isSuccess' => $statusCode >= 200 && $statusCode < 300,
            'status' => ['statusCode' => $statusCode],
        ];
    }
}
