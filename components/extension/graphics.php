<?php

namespace Components\extension;
use Components\core\treits\globalFunction;

/**
 * Class graphics
 * @package Components\extension
 */


class graphics
{


    use globalFunction;


    /**
     * @var string
     */

    private static $upload_path = 'public/images/';



    /**
     * @var string $name Keys in $_FILES[key]
     */


    private static $name;

    /**
     * @var string temp img
     */

    private $temp;


    /**
     * @var string $ext jpg|jpeg|png|gif|bmp
     */

    private static $ext;


    /**
     * graphics constructor.
     */

    public function __construct()
    {
       $this->temp = self::uploads('temp/')->saveFile(self::$name,self::$upload_path);
       self::$upload_path = 'public/images/';
    }


    public function getName(): string
    {
        return $_FILES[self::$name]['name'];
    }

    public function getPath(): string
    {
        return self::$upload_path.$_FILES[self::$name]['name'];
    }


    /**
     * @param string $name
     * @return graphics
     */

    public static function img($name = 'img'): graphics
    {
        self::$name = $name;

        return new self();
    }

    /**
     * @return string
     */

    public function save(): string
    {
        copy($this->temp,self::$upload_path.$this->getName());

        unlink($this->temp);

        return $this->getName();
    }


    /**
     * @param string $upload_path
     * @return $this
     */

    public function uploads(string $upload_path = 'public/images/'): graphics
    {
        self::$upload_path = $upload_path;

        return $this;
    }




    /**
     * @param int $width
     * @param int $height
     * @return graphics
     */


    public function maxSizeImg(int $width, int $height): graphics
    {
        $sizes = getimagesize($this->temp);


        if ($sizes[0] > $width || $sizes[1] > $height) {

            $this->riseSizeImg($width, $height);

        }

        return $this;
    }




    /**
     * @param int $width
     * @param int $height
     * @return void
     */


    public function riseSizeImg(int $width, int $height): void
    {
        $sizes = $this->correlationImgSize($width, $height);

        $new_image = imagecreatetruecolor($sizes['new_width'], $sizes['new_height']);

        imagecopyresampled($new_image,$this->createImg($this->temp), 0, 0, 0, 0, $sizes['new_width'], $sizes['new_height'],$sizes['width'],$sizes['height']);

        $this->saveImg($new_image,$this->temp);
    }

    /**
     * @param int $width
     * @param int $height
     * @return array
     */


    private function correlationImgSize(int $width, int $height): array
    {
        $sizes = getimagesize($this->temp);

        $ratio_orig = $sizes[0] / $sizes[1];

        if ($width / $height > $ratio_orig) {
            $width = $height * $ratio_orig;
        } else {
            $height = $width / $ratio_orig;
        }

        return ['new_width' => $width, 'new_height' => $height,
            'width' => $sizes[0], 'height' => $sizes[1]];
    }


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