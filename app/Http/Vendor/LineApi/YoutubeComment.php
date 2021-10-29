<?php

namespace App\Http\Vendor\LineApi;

use App\Http\Vendor\LineApi\FlexMessages\ImageIconTextList;
use App\Http\Vendor\LineApi\FlexMessages\ImageIconTextList\ImageIconTextBody;
use App\Http\Vendor\LineApi\FlexMessages\ImageIconTextList\ImageIconTextBodyText;
use App\Http\Vendor\LineApi\LineApi;
use LINE\LINEBot;
use App\Http\Vendor\YoutubeApi;

class YoutubeComment extends LineApi
{
    private $altText = '動画のコメントよ。';

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
            $comments = $youtubeApi->getMostRecentCommentsForVideoIdFilterMemberChannel($videoId);
            if(empty($comments)) {
                return;
            }

            $ImageIconTextBodies = [];
            foreach ($comments as $comment) {
                $comment['textDisplay'] = htmlspecialchars_decode($comment['textDisplay']);
                $comment['textDisplay'] = str_replace('<br>', PHP_EOL, $comment['textDisplay']);

                // 通常テキストと a タグに分割して配列に格納
                // テキストが「HOGE<a href="hoge"></a>FUGA」の場合は
                // [0] = HOGE, [1] = <a href="hoge"></a>, [2] = FUGA のように格納する
                $imageIconTextBodyTexts = [];
                $linkPattern = '/<a href="(.*?)">(.*?)<\/a>/';
                while(preg_match($linkPattern, $comment['textDisplay'], $matches, PREG_OFFSET_CAPTURE)) {
                    $beforeTarget = substr($comment['textDisplay'], 0, $matches[0][1]);
                    $target = substr($comment['textDisplay'], $matches[0][1], strlen($matches[0][0]));
                    if (!empty($beforeTarget)) {
                        $imageIconTextBodyTexts[] = new ImageIconTextBodyText($beforeTarget);
                    }
                    $imageIconTextBodyTexts[] = new ImageIconTextBodyText($matches[2][0], $matches[1][0]);

                    $comment['textDisplay'] = str_replace([$beforeTarget, $target], '', $comment['textDisplay']);

                }
                if (!empty($comment['textDisplay'])) {
                    $imageIconTextBodyTexts[] = new ImageIconTextBodyText($comment['textDisplay']);
                }

                $ImageIconTextBodies[] = new ImageIconTextBody($comment['authorProfileImageUrl'], $imageIconTextBodyTexts);
            }

            $imageIconTextList = new ImageIconTextList();
            $imageIconTextList->setHeader('#97FEA7FF', $this->altText, '#707070FF');
            $imageIconTextList->setBody($ImageIconTextBodies);

            $this->lineBot->replyMessage($replyToken, $imageIconTextList->getContainerBuilder($this->altText));
        }
    }
}
