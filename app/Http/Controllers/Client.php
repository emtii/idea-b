<?php declare(strict_types=1);

namespace App\Http\Controllers;

/**
 * Class Client
 * @package App\Http\Controllers
 */
class Client extends Controller
{
    /**
     * @var string
     */
    private $harvest_api_base_url;
    /**
     * @var string
     */
    private $harvest_api_user;
    /**
     * @var string
     */
    private $harvest_api_pass;

    private $client;

    /**
     * Client constructor.
     */
    public function __construct()
    {
        $this->harvest_api_base_url = env('HARVEST_API_BASE_URL');
        $this->harvest_api_user = env('HARVEST_API_USER');
        $this->harvest_api_pass = env('HARVEST_API_PASS');
    }

    /**
     * @param $request
     * @return array
     */
    public function getResponse($request) : array
    {
        // TODO: Refactor to Guzzle
        // TODO: move API to its own package.

        if ($this->requestExists($request)) {
            trim($request);

            $headers = [
                'Content-type: application/json',
                'Accept: application/json',
                'Authorization: Basic ' . base64_encode(
                    $this->harvest_api_user . ':' . $this->harvest_api_pass
                )
            ];

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $this->harvest_api_base_url . $request);
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
        } else {
            return [];
        }

        return [];
    }

    /**
     * @param $request
     * @return bool
     */
    private function requestExists($request) : bool
    {
        return $request !== null || $request !== '';
    }
}
