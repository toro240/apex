<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Vender\YoutubeApi;
use App\Http\Vender\LineApi_YoutubeComment;

class TestController extends Controller
{
  public function index(Request $request)
  {
    $lineApi = new LineApi_YoutubeComment($request);
    if(!$lineApi->isUseLineApi()) {
      return;
    }

    $lineApi->sendYoutubeComment();

    $youtubeApi = new YoutubeApi();
    $comments = $youtubeApi->getTopLevelCommentsForChannelId('UC_DXwXoaSsY1vN5dJjrCi1w');
    return $comments;
  }
}
