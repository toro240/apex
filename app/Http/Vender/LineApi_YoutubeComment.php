<?php

namespace App\Http\Vender;

use App\Http\Vender\LineApi;
use LINE\LINEBot;
use App\Http\Vender\YoutubeApi;

class LineApi_YoutubeComment extends LineApi
{
    private $member_ids = [
      '西尾真' => [
        'channelId' => 'UC_DXwXoaSsY1vN5dJjrCi1w',
      ],
      'にぶたに' => [
        'channelId' => 'UCvQMtplgGxSrObwZCM9vmHw',
      ],
      '達也伊藤' => [
        'channelId' => 'UCL5ocCJCmUE_aLdzgKCsA2Q',
      ]
    ];

    private $watch_link = "https://www.youtube.com/watch?v=";

    public function sendYoutubeComment()
    {
      $youtubeApi = new YoutubeApi();

      foreach ($this->events as $event) {
        $reply_token = $event->getReplyToken();
        if (!$event instanceof LINEBot\Event\MessageEvent\TextMessage) {
          return;
        }

        $message = $event->getText();
        $message_list = explode(PHP_EOL, $message);

        if(!str_starts_with($message, '/コメント')) {
          return;
        }

        if(!isset($message_list[1]) || !isset($this->member_ids[$message_list[1]])) {
          return;
        }

        $channel_name = $message_list[1];

        $comments = $youtubeApi->getTopLevelCommentsForChannelId($this->member_ids[$channel_name]['channelId']);
        $group_video_ids = [];
        foreach ($comments as $comment) {
          $group_video_ids[$comment['videoId']][] = $comment;
        }

        $send_texts = [];
        foreach ($group_video_ids as $video_id => $group_video_id) {
          $video_link = $this->watch_link . $video_id;
          $one_video_texts = [];
          foreach($group_video_id as $comment) {
            array_push($one_video_texts, $comment['textOriginal']);
          }

          array_push(
            $send_texts,
            $video_link . PHP_EOL . 'にコメントがあります。' . PHP_EOL . implode(PHP_EOL, $one_video_texts) . PHP_EOL . '~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~'
          );
        }

        $this->lineBot->replyText($reply_token, implode(PHP_EOL, $send_texts));
      }
    }
}
