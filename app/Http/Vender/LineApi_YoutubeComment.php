<?php

namespace App\Http\Vender;

use App\Http\Vender\LineApi;
use LINE\LINEBot;

class LineApi_YoutubeComment extends LineApi
{
    public function sendYoutubeComment()
    {
      foreach ($this->events as $event) {
        $reply_token = $event->getReplyToken();
        if (!$event instanceof LINEBot\Event\MessageEvent\TextMessage) {
          continue;
        }

        $message = $event->getText();
        if(!str_starts_with($message, '/コメント')) {
          continue;
        }

        $bot->replyText($reply_token, 'hoge');
      }
    }
}
