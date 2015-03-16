<?php namespace DigitalUnited\ResponsiveImages\Markup;

use DigitalUnited\ResponsiveImages\ImageSource;
use HtmlGenerator\HtmlTag;

class ImageTag
{
    private $settings;

    function __construct(Array $settings)
    {
        $this->settings = $settings;
    }

    public function render()
    {
        $img = $this->buildImgTag();
        $noScriptImg = $this->buildNoScriptImgTag();

        $wrapperDiv = $this->buildWrapperDiv($img . $noScriptImg);

        return $wrapperDiv;
    }

    private function buildImgTag()
    {
        $this->settings['imgAttributes']['data-srcset'] =
            (new ImageSource($this->settings['imgId'], $this->settings['sizes']))->generateImgDataSrcset();

        $img = HtmlTag::createElement('img');

        foreach ($this->settings['imgAttributes'] as $attrName => $attrValues) {
            $attributeString = $this->getAttrValueAsString($attrValues);
            $img->set($attrName, $attributeString);
        }

        return $img;
    }

    /**
     * @param $attrValue
     * @return string
     */
    private function getAttrValueAsString($attrValue)
    {
        if (is_array($attrValue)) {
            return implode(' ', $attrValue);
        }

        return $attrValue;
    }

    private function buildWrapperDiv($content)
    {
        $div = HtmlTag::createElement('div');

        $div->text($content);

        $this->applyRatioSettingOnWrapper();

        foreach ($this->settings['wrapperAttributes'] as $attrName => $attrValues) {
            $attributeString = $this->getAttrValueAsString($attrValues);
            $div->set($attrName, $attributeString);
        }

        return $div;
    }

    private function applyRatioSettingOnWrapper()
    {
        $this->settings['wrapperAttributes']['class'][] = 'du-ratio-' . $this->settings['ratio'];
    }

    private function buildNoScriptImgTag()
    {
        $fallbackImgUrl = (new ImageSource($this->settings['imgId']))
            ->getFallbackImgUrl();

        $img = HtmlTag::createElement('img')
            ->set('src', $fallbackImgUrl)
            ->set('class', 'du-resp-img');

        $noScript = HtmlTag::createElement('noscript');
        $noScript->text($img);

        return $noScript;
    }
}