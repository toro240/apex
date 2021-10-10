<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Vender\YoutubeApi;
use LINE\LINEBot;
use Illuminate\Support\Facades\Log;

class TestController extends Controller
{
  public function index(Request $request)
  {
    Log::info('Hello Logplex!');
    /** @var LINEBot $bot */
    $bot = app('line-bot');

    $signature = $request->headers->get(LINEBot\Constant\HTTPHeader::LINE_SIGNATURE);
    Log::info($signature);
    if (!isset($signature)) {
      return;
    }

    if (!LINEBot\SignatureValidator::validateSignature($request->getContent(), env('LINE_CHANNEL_SECRET'), $signature)) {
      return;
    }

    $events = $bot->parseEventRequest($request->getContent(), $signature);

    foreach ($events as $event) {
      $reply_token = $event->getReplyToken();
      if (!$event instanceof LINEBot\Event\MessageEvent\TextMessage) {
        continue;
      }

      $message = $event->getText();
      if(!str_starts_with($message, '/コメント')) {
        continue;
      }
      Log::info($message);

      $bot->replyText($reply_token, 'hoge');
    }

    $youtubeApi = new YoutubeApi();
    $comments = $youtubeApi->getTopLevelCommentsForChannelId('UC_DXwXoaSsY1vN5dJjrCi1w');
    return $comments;
  }
}
