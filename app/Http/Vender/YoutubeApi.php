<?php

namespace App\Http\Vender;

use DateTime;
use Google_Client;
use Google_Service_YouTube;

class YoutubeApi
{
    private $youtube;

    public function __construct()
    {
      $client = new Google_Client();
      $client->setDeveloperKey(env('GOOGLE_API_KEY'));
      $this->youtube = new Google_Service_YouTube($client);
    }

    /**
     * videoIdの動画に対する最新20件のコメントを取得する
     *
     * @param string $videoId videoId
     * @return array videoIdに対する最新20件のコメント
     */
    public function getMostRecentCommentsForVideoId(String $videoId)
    {
      $comments = $this->youtube->commentThreads->listCommentThreads('snippet', [
         'videoId' => $videoId
      ]);

      $formated = collect($comments->getItems())->pluck('snippet')->all();
      $topLevelComments = array_column($formated,'topLevelComment');
      $comments = array_column($topLevelComments,'snippet');

      return $comments;
    }

    /**
     * channelIdから完了したブロードキャストを10件取得
     *
     * @param string $channelId channelId
     * @return array 完了したブロードキャスト10件
     */
    public function getCompletedBroadcasts(String $channelId)
    {

      // $dt = new DateTime('2021-10-09 12:00:00 Asia/Tokyo');
      $comments = $this->youtube->search->listSearch('snippet', [
         'regionCode' => 'JP',
         'channelId' => $channelId,
         'order' => 'date',
         // 'publishedAfter' => $dt->format(DateTime::RFC3339),
         'maxResults' => 50
      ]);

      $formated = collect($comments->getItems())->all();

      return $formated;
    }
}
