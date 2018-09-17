<?php


namespace Components\extension\graphics;


abstract class generalGraphic
{

    /**
     * @var string $ext jpg|jpeg|png|gif|bmp
     */

    protected static $ext;


    /**
     * @param string $file
     * @return string
     */


    private static function extens(string $file): string
    {
        if (empty(self::$ext)) {
            self::$ext = new \SplFileInfo($file);
        }
        return self::$ext->getExtension();
    }

    /**
     * @param string $url
     * @return resource
     */


    public function createImg(string $url)
    {
        $ext = self::extens($url);

        switch ($ext) {
            case 'png':
                return imagecreatefrompng($url);
            case 'jpg' || 'jpeg':
                return imagecreatefromjpeg($url);
            case 'bmp':
                return imagecreatefrombmp($url);
            case 'gif':
                return imagecreatefromgif($url);
        }
    }



    /**
     * @param resource $resource
     * @param string $filename
     */

    public function saveImg($resource, string $filename): void
    {
        $ext = self::extens($filename);

        switch ($ext) {
            case 'png':
                imagepng($resource, $filename);
                break;
            case 'jpg' || 'jpeg':
                imagejpeg($resource, $filename);
                break;
            case 'bmp':
                imagebmp($resource, $filename);
                break;
            case 'gif':
                imagegif($resource, $filename);
                break;
        }

        imagedestroy($resource);
    }
}