<?php

namespace App\Http\Vender;

use App\Http\Vender\LineApi;
use LINE\LINEBot;
use App\Http\Vender\YoutubeApi;

class LineApi_YoutubeComment extends LineApi
{

    public function sendYoutubeComment()
    {
      $youtubeApi = new YoutubeApi();

      foreach ($this->events as $event) {
        $replyToken = $event->getReplyToken();
        if (!$event instanceof LINEBot\Event\MessageEvent\TextMessage) {
          return;
        }

        $message = $event->getText();
        preg_match('/(?J)^(https:\/\/www.youtube.com\/watch\?v=(?P<name>.*)$)|^(https:\/\/youtu.be\/(?P<name>.*)$)/', $message, $matches);
        if(!isset($matches['name'])) {
          return;
        }
        $videoId = $matches['name'];
        $comments = $youtubeApi->getMostRecentCommentsForVideoId($videoId);

        $sendTexts = [];
        foreach ($comments as $comment) {
          $comment['textDisplay'] = htmlspecialchars_decode($comment['textDisplay']);
          $comment['textDisplay'] = str_replace('<br>', PHP_EOL, $comment['textDisplay']);
          $comment['textDisplay'] = preg_replace('/<a href="(.*?)">.*?<\/a>/', "$1", $comment['textDisplay']);
          array_push($sendTexts, $comment['textDisplay'] . PHP_EOL . '~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~');
        }

        $this->lineBot->replyText($replyToken, '動画のコメントよ。' . '~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~' . PHP_EOL . implode(PHP_EOL, $sendTexts));
      }
    }
}
