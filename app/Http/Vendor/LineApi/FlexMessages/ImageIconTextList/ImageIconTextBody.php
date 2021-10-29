<?php

namespace App\Http\Vendor\LineApi\FlexMessages\ImageIconTextList;

class ImageIconTextBody
{
    private $imageUrl;
    private $texts;

    /**
     * @param string $imageUrl
     * @param ImageIconTextBodyText[] $imageIconTextBodyText
     */
    public function __construct(string $imageUrl, array $imageIconTextBodyText)
    {
        $this->imageUrl = $imageUrl;
        $this->texts = $imageIconTextBodyText;
    }

    /**
     * @return string
     */
    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    /**
     * @return ImageIconTextBodyText[]
     */
    public function getTexts(): array
    {
        return $this->texts;
    }
}
