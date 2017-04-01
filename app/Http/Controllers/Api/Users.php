<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class Users extends Controller
{
    const HARVEST_API_ENDPOINT = 'people/';

    public function getUserEmailById($uid)
    {
        $request = '' . $uid;

        Log::info('Request: ' . $request);

        $client = new Client(self::HARVEST_API_ENDPOINT, $request);

        $response = $client->getResponse();

        return $response['user']['email'];
    }

    public function getUserNameById($uid)
    {
        $request = '' . $uid;

        Log::info('Request: ' . $request);

        $client = new Client(self::HARVEST_API_ENDPOINT, $request);

        $response = $client->getResponse();

        return $response['user']['first_name'] . ' ' . $response['user']['last_name'];
    }
}
