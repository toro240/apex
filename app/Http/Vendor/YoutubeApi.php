<?php

namespace App\Http\Vendor;

use DateTime;
use Google_Client;
use Google_Service_YouTube;

class YoutubeApi
{
    private $youtube;

    private $memberChannelIds = [
        'UC_DXwXoaSsY1vN5dJjrCi1w', // 西尾真
        'UCvQMtplgGxSrObwZCM9vmHw', // にぶたに
        'UCL5ocCJCmUE_aLdzgKCsA2Q', // 達也伊藤
    ];

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
    public function getMostRecentCommentsForVideoId(String $videoId): array
    {
        $comments = $this->youtube->commentThreads->listCommentThreads('snippet', [
            'videoId' => $videoId
        ]);

        $snippet = collect($comments->getItems())->pluck('snippet')->all();
        if (empty($snippet)) {
            return [];
        }
        $topLevelComments = array_column($snippet,'topLevelComment');
        return array_column($topLevelComments,'snippet');
    }

    /**
     * $this->memberChannelIds に含まれるチャンネルの動画に対する最新20件のコメントを取得する
     *
     * @param string $videoId videoId
     * @return array videoIdに対する最新20件のコメント
     */
    public function getMostRecentCommentsForVideoIdFilterMemberChannel(String $videoId): array
    {
        $videos = $this->youtube->videos->listVideos("snippet", [
            'id' => $videoId,
        ]);
        $snippet = collect($videos->getItems())->pluck('snippet')->all();
        if (empty($snippet)) {
            return [];
        }
        if (!in_array($snippet[0]->channelId, $this->memberChannelIds)) {
            return [];
        }

        return $this->getMostRecentCommentsForVideoId($videoId);
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

        return collect($comments->getItems())->all();
    }
}
