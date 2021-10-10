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

    if (!isset($_SERVER['HTTP_'.LINEBot\Constant\HTTPHeader::LINE_SIGNATURE])) {
      Log::info('isset...');
      return;
    }

    $signature = $_SERVER['HTTP_' . LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];
    if (!LINEBot\SignatureValidator::validateSignature($request->getContent(), env('LINE_CHANNEL_SECRET'), $signature)) {
      Log::info('validateSignature...');
      return;
    }

    $events = $bot->parseEventRequest($request->getContent(), $signature);

    /** @var LINEBot\Event\BaseEvent $event */
    foreach ($events as $event) {
      $reply_token = $event->getReplyToken();
      Log::info('event');
      if (!$event instanceof TextMessage) {
        continue;
      }
      Log::info('textMessage');
      $bot->replyText($reply_token, 'hoge');
    }

    $youtubeApi = new YoutubeApi();
    $comments = $youtubeApi->getTopLevelCommentsForChannelId('UC_DXwXoaSsY1vN5dJjrCi1w');
    return $comments;
  }
}
