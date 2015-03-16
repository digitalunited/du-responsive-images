<?php namespace DigitalUnited\ResponsiveImages\Markup;

use DigitalUnited\ResponsiveImages\ImageSource;
use HtmlGenerator\HtmlTag;

class DivWithBgImage
{
    private $settings;

    function __construct(Array $settings)
    {
        $this->settings = $settings;
    }

    public function render()
    {
        $wrapperDiv = $this->buildWrapperDiv();

        return $wrapperDiv;
    }

    private function buildWrapperDiv()
    {
        $this->settings['divWithBgImageAttributes']['data-bgset'] =
            (new ImageSource($this->settings['imgId'], $this->settings['sizes']))->generateImgDataSrcset();

        $this->addRatioClass();

        $div = HtmlTag::createElement('div');

        if (isset($this->settings['content'])) {
            $div->text($this->settings['content']);
        }

        foreach ($this->settings['divWithBgImageAttributes'] as $attrName => $attrValues) {
            $attributeString = $this->getAttrValueAsString($attrValues);
            $div->set($attrName, $attributeString);
        }

        return $div;
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

    private function addRatioClass()
    {
        if (!empty($this->settings['ratio'])) {
            $this->settings['divWithBgImageAttributes']['class'][] = 'du-ratio-' . $this->settings['ratio'];
        }
    }
}