<?php namespace DigitalUnited\ResponsiveImages;

use DigitalUnited\ResponsiveImages\Markup\DivWithBgImage;
use DigitalUnited\ResponsiveImages\Markup\ImageTag;
use DigitalUnited\ResponsiveImages\Markup\SrcsetString;

/**
 * Class ResponsiveImages
 * @package DigitalUnited\ResponsiveImages
 */
class ResponsiveImages
{
    private $settings = [
        'sizes' => [
            200, 300, 400, 600, 750, 1024, 1500, 2000
        ],
        'ratio' => '16x9',
        'imgAttributes' => [
            'class' => ['du-resp-img', 'lazyload'],
            'data-sizes' => 'auto',
            'alt' => '',
            'title' => '',
            'src' => 'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=='
        ],
        'wrapperAttributes' => [
            'class' => ['du-resp-img-ratio-wrapper'],
        ],
        'divWithBgImageAttributes' => [
            'class' => ['du-resp-div-bg', 'lazyload', 'center'],
            'data-sizes' => 'auto',
        ],
    ];

    /**
     * @param array $settings
     * @throws \Exception
     */
    function __construct(Array $settings)
    {
        if (empty($settings['imgId'])) {
            throw new \Exception('Param imgId is missing.');
        }

        if (empty($settings['output'])) {
            throw new \Exception('Param output is missing.');
        }

        $this->settings = (new ParseSettings($this->settings, $settings))->getSettings();
    }

    public function render()
    {
        switch ($this->settings['output']) {
            case 'img':
                return (new ImageTag($this->settings))->render();
            case 'div':
                return (new DivWithBgImage($this->settings))->render();
            case 'srcset':
                return (new SrcsetString($this->settings))->render();
        }

        throw new \Exception('Select output-mode was not found');
    }
}