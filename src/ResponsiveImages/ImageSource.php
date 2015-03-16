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
            $previousIndex = isset($this->sizes[$index - 1]) ? $index - 1 : 0;

            //--$index so the last renderd image is full width if image is smaller then largest requested size.
            if ($this->sizes[$previousIndex] < $imageWidth) {
                $imageUrls[$width] = aq_resize($imageUrl, $width, $imageHeight);
            }
        }

        return $imageUrls;
    }
}