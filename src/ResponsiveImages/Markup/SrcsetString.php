<?php namespace DigitalUnited\ResponsiveImages\Markup;

use DigitalUnited\ResponsiveImages\ImageSource;
use HtmlGenerator\HtmlTag;

class SrcsetString
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
        $srcset = (new ImageSource($this->settings['imgId'], $this->settings['sizes']))
            ->generateImgDataSrcset();

        return $srcset;
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
}