<?php
declare(strict_types=1);

namespace App\Http\Controllers;

class Client extends Controller
{
    private $endpoint;
    private $request;
    private $harvest_api_base_url;
    private $harvest_api_user;
    private $harvest_api_pass;

    public function __construct(
        $endpoint,
        $request
    ) {
        $this->endpoint = $endpoint;
        $this->request = $request;

        $this->harvest_api_base_url = env('HARVEST_API_BASE_URL');
        $this->harvest_api_user = env('HARVEST_API_USER');
        $this->harvest_api_pass = env('HARVEST_API_PASS');
    }

    public function getResponse()
    {
        $headers = [
            'Content-type: application/json',
            'Accept: application/json',
            'Authorization: Basic ' . base64_encode(
                $this->harvest_api_user . ':' . $this->harvest_api_pass
            )
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->harvest_api_base_url . $this->endpoint . $this->request);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_USERAGENT, 'B v0.0.1 (thiesies@bestit-online.de');

        $data = curl_exec($ch);

        $json = json_decode($data, true);

        if (curl_errno($ch)) {
            curl_close($ch);
            print 'Error: ' . curl_error($ch);
        } else {
            curl_close($ch);
            return $json;
        }

        return [];
    }
}
