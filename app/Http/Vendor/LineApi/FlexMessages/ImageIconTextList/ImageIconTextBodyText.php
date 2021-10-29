<?php

namespace App\Http\Vendor\LineApi\FlexMessages\ImageIconTextList;

class ImageIconTextBodyText
{
    private $text;
    private $url;
    public function __construct(string $text, string $url = null)
    {
        $this->text = $text;
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }
}
