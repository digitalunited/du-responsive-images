<?php namespace DigitalUnited\ResponsiveImages;

class ImageSource
{

    private $imgId;
    private $sizes;

    function __construct($imgId, $sizes = [])
    {
        $this->imgId = $imgId;
        $this->sizes = $sizes;
    }

    public function getFallbackImgUrl()
    {
        return \wp_get_attachment_image_src($this->imgId, 'large')[0];
    }

    public function generateImgDataSrcset()
    {
        $images = $this->getImageUrls();

        $dataSrcsetArray = [];
        foreach ($images as $maxWidth => $url) {
            $dataSrcsetArray[] = "{$url} {$maxWidth}w";
        }

        $dataSrcsetString = implode(', ', $dataSrcsetArray);

        return $dataSrcsetString;
    }

    private function getImageUrls()
    {
        $imageUrls = [];

        $fullSizeImage = \wp_get_attachment_image_src($this->imgId, 'full');
        $imageUrl = $fullSizeImage[0];
        $imageWidth = $fullSizeImage[1];
        $imageHeight = $fullSizeImage[2];

        foreach ($this->sizes as $index => $width) {
            if ($width < $imageWidth) {
                $imageUrls[$width] = aq_resize($imageUrl, $width, $imageHeight);
            }
            else {
                // Use $imageWidth - 1 so we always get a cropped image
                $maxWidth = $imageWidth - 1;
                $imageUrls[$maxWidth] = aq_resize($imageUrl, $maxWidth, $imageHeight);

                break; //I know this is bad.
            }
        }

        return $imageUrls;
    }
}