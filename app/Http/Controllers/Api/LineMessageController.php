<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Vendor\LineApi\YoutubeComment;
use LINE\LINEBot\Exception\InvalidSignatureException;

class LineMessageController extends Controller
{
    /**
     * @throws InvalidSignatureException
     */
    public function index(Request $request)
    {
        $lineApi = new YoutubeComment($request);
        if(!$lineApi->isUseLineApi()) {
            return;
        }

        $lineApi->sendYoutubeComment();
    }
}
