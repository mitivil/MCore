<?php

namespace MCore\System\Tools;

use MCore\System\Tools;

class TImagick
{
    public static function quality($path_file, $quality)
    {
        // phpinfo();
        // exit;
        $imagick = new \Imagick($path_file);
        $imagick->setImageCompressionQuality($quality);
        $imagick->writeImage($path_file);
        // $imagick->setImageCompressionQuality($quality);
        // $imagick->writeImage($path_file);
        // $imagick->clear();
    }

    public static function resize($path_file, $width)
    {
        //The blur factor where &gt; 1 is blurry, &lt; 1 is sharp.
        $imagick = new \Imagick(realpath($path_file));
        $cropWidth = $imagick->getImageWidth();
        $cropHeight = $imagick->getImageHeight();
        if ((int)$cropWidth <= (int)$width) return '';

        $img_size = self::calculateDimensions($cropWidth, $cropHeight, $width);
        if ((int)$img_size['height'] <= 0) return '';
        if ((int)$img_size['width'] <= 0) return '';
       
        // Resize the image
        $imagick->resizeImage($img_size['width'], $img_size['height'], \Imagick::FILTER_LANCZOS, 1);
        $imagick->writeImage($path_file);
    }


    private static function calculateDimensions($width, $height, $maxwidth, $maxheight = 10000)
    {

        if ($width != $height) {
            if ($width > $height) {
                $t_width = $maxwidth;
                $t_height = (($t_width * $height) / $width);
                //fix height
                if ($t_height > $maxheight) {
                    $t_height = $maxheight;
                    $t_width = (($width * $t_height) / $height);
                }
            } else {
                $t_height = $maxheight;
                $t_width = (($width * $t_height) / $height);
                //fix width
                if ($t_width > $maxwidth) {
                    $t_width = $maxwidth;
                    $t_height = (($t_width * $height) / $width);
                }
            }
        } else
            $t_width = $t_height = min($maxheight, $maxwidth);

        return array('height' => (int)$t_height, 'width' => (int)$t_width);
    }
}
