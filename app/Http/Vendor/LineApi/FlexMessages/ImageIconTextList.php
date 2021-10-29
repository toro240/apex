<?php

namespace App\Http\Vendor\LineApi\FlexMessages;

use App\Http\Vendor\LineApi\FlexMessages\ImageIconTextList\ImageIconTextBody;
use LINE\LINEBot\Constant\Flex\ComponentAlign;
use LINE\LINEBot\Constant\Flex\ComponentFontSize;
use LINE\LINEBot\Constant\Flex\ComponentFontWeight;
use LINE\LINEBot\Constant\Flex\ComponentGravity;
use LINE\LINEBot\Constant\Flex\ComponentLayout;
use LINE\LINEBot\Constant\Flex\ComponentMargin;
use LINE\LINEBot\Constant\Flex\ComponentSpacing;
use LINE\LINEBot\Constant\Flex\ComponentTextDecoration;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\BoxComponentBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\ImageComponentBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\SeparatorComponentBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\TextComponentBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ContainerBuilder\BubbleContainerBuilder;
use LINE\LINEBot\MessageBuilder\FlexMessageBuilder;
use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;

class ImageIconTextList
{
    /**
     * @var BoxComponentBuilder
     */
    private $header;

    /**
     * @var
     */
    private $body;

    /**
     * @param $backgroundColor string ヘッダー背景色　16進数カラーコード
     * @param $text string ヘッダーテキスト
     * @param $color string ヘッダーテキスト色　16進数カラーコード
     * @return void
     */
    public function setHeader(string $backgroundColor, string $text, string $color)
    {
        $textComponentBuilder = new TextComponentBuilder($text);
        $textComponentBuilder->setWeight(ComponentFontWeight::BOLD);
        $textComponentBuilder->setSize(ComponentFontSize::MD);
        $textComponentBuilder->setColor($color);

        $boxComponentBuilder = new BoxComponentBuilder(ComponentLayout::VERTICAL, [$textComponentBuilder]);
        $boxComponentBuilder->setBackgroundColor($backgroundColor);
        $this->header = $boxComponentBuilder;
    }

    /**
     * @param ImageIconTextBody[] $imageIconTextBodies
     * @return void
     */
    public function setBody(array $imageIconTextBodies)
    {
        $componentBuilderForLines = [];
        foreach ($imageIconTextBodies as $imageIconTextBody) {
            $imageComponentBuilder = new ImageComponentBuilder($imageIconTextBody->getImageUrl());
            $imageComponentBuilder->setFlex(1);
            $imageComponentBuilder->setAlign(ComponentAlign::START);
            $imageComponentBuilder->setGravity(ComponentGravity::CENTER);

            $texts = $imageIconTextBody->getTexts();
            $componentBuilderForTexts = [];
            foreach($texts as $text) {
                $textComponentBuilder = new TextComponentBuilder($text->getText());
                $textComponentBuilder->setContents([]);
                $textComponentBuilder->setWrap(true);
                $textUrl = $text->getUrl();
                if (!is_null($textUrl)) {
                    $textComponentBuilder->setColor('#678CF9FF');
                    $textComponentBuilder->setWeight(ComponentFontWeight::BOLD);
                    $textComponentBuilder->setDecoration(ComponentTextDecoration::UNDERLINE);
                    $templateActionBuilder = new UriTemplateActionBuilder($text->getText(), $textUrl);
                    $textComponentBuilder->setAction($templateActionBuilder);
                }
                $componentBuilderForTexts[] = $textComponentBuilder;
            }
            $boxTextsComponentBuilder = new BoxComponentBuilder(ComponentLayout::VERTICAL, $componentBuilderForTexts, 4, null, ComponentMargin::SM);
            $componentBuilderForLines[] = new BoxComponentBuilder(ComponentLayout::HORIZONTAL, [
                $imageComponentBuilder,
                $boxTextsComponentBuilder,
            ], 1);
            $componentBuilderForLines[] = new SeparatorComponentBuilder();
        }


        $this->body = new BoxComponentBuilder(ComponentLayout::VERTICAL, $componentBuilderForLines,null, ComponentSpacing::MD);
    }

    public function getContainerBuilder($altText): FlexMessageBuilder
    {
        $container = new BubbleContainerBuilder();
        $container->setHeader($this->header);
        $container->setBody($this->body);

        return new FlexMessageBuilder($altText, $container);
    }
}
