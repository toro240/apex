<?php

namespace App\Http\Vender;

use LINE\LINEBot;

class LineApi
{
    protected $lineBot;
    protected $events;

    public function __construct(Request $request)
    {
      $this->lineBot = app('line-bot');
      $signature = $request->headers->get(LINEBot\Constant\HTTPHeader::LINE_SIGNATURE);
      if (isset($signature) && LINEBot\SignatureValidator::validateSignature($request->getContent(), env('LINE_CHANNEL_SECRET'), $signature)) {
        $this->events = $this->lineBot->parseEventRequest($request->getContent(), $signature);
      }
    }

    public function isUseLineApi()
    {
      return !is_null($this->events)
    }
}
