<?php

namespace App\Http\Vender;

use DateTime;
use Google_Client;
use Google_Service_YouTube;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot;

class LineApi
{
    private $lineBot;

    public function __construct()
    {
      $http_client = new CurlHTTPClient(env('LINE_ACCESS_TOKEN'));
      $this->lineBot = new LINEBot($http_client, ['channelSecret' => env('LINE_CHANNEL_SECRET')]);
    }
}
