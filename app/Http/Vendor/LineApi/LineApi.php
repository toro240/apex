<?php

namespace App\Http\Vendor\LineApi;

use LINE\LINEBot;
use Illuminate\Http\Request;
use function app;
use function env;

class LineApi
{
    protected $lineBot;
    protected $events;

    /**
     * @throws LINEBot\Exception\InvalidSignatureException
     */
    public function __construct(Request $request)
    {
        $this->lineBot = app('line-bot');
        $signature = $request->headers->get(LINEBot\Constant\HTTPHeader::LINE_SIGNATURE);
        if (isset($signature) && LINEBot\SignatureValidator::validateSignature($request->getContent(), env('LINE_CHANNEL_SECRET'), $signature)) {
            $this->events = $this->lineBot->parseEventRequest($request->getContent(), $signature);
        }
    }

    public function isUseLineApi(): bool
    {
        return !is_null($this->events);
    }
}
