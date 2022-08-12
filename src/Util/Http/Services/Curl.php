<?php

namespace App\Util\Http\Services;

use Symfony\Component\HttpFoundation\Response;

class Curl implements HttpInterface
{

    public function request(string $method, string $url, array $params = []): Response
    {
        $curl = curl_init();

        switch ($method){
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($params)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                if ($params)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
                break;
            default:
                if ($params)
                    $url = sprintf("%s?%s", $url, http_build_query($params));
        }

        curl_setopt($curl, CURLOPT_HEADER, 1);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $params['header'] ?? []);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);
        $curlInfo = curl_getinfo($curl);

        $httpCode = $curlInfo['http_code'];

        $headerSize = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $headerString = substr($result, 0, $headerSize);
        $body = substr($result, $headerSize);

        curl_close($curl);

        $headers = array_filter(explode("\r\n", $headerString));

        return new Response($body, $httpCode, $headers);
    }
}