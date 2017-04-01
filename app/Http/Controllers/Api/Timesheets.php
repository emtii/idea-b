<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Client;
use App\Http\Controllers\Controller;

class Timesheets extends Controller
{
    const HARVEST_API_ENDPOINT = 'daily/';

    private $user;

    public function __construct()
    {
        $this->user = new Users();
    }

    public function getEntriesOfCurrentDay()
    {


        $client = new Client(self::HARVEST_API_ENDPOINT, $request);

        return $client->getResponse();
    }
}
