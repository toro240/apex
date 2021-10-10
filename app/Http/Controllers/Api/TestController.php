<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
  }
}
