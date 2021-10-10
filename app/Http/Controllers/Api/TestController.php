<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Vender\YoutubeApi;

class TestController extends Controller
{
  public function index()
  {
    $youtubeApi = new YoutubeApi();
    $comments = $youtubeApi->getTopLevelCommentsForChannelId('UC_DXwXoaSsY1vN5dJjrCi1w');
    return $comments;
  }
}
