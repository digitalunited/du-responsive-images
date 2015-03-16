<?php namespace DigitalUnited;

class ResponsiveImage
{
    public static function render($settings)
    {
        $respImg = (new \DigitalUnited\ResponsiveImages\ResponsiveImages($settings));

        return $respImg->render();
    }
}