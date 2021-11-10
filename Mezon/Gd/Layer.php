<?php
namespace Mezon\Gd;

use Mezon\Conf\Conf;

class Layer
{

    /**
     * Image sizes
     *
     * @var array[]
     */
    public static $imageSize = [];

    /**
     * Method returns image size
     *
     * @param string $fileName
     *            path to the image size
     * @param array $imageInfo
     *            image info
     * @return array image sizes
     */
    public static function getImageSize(string $fileName, array &$imageInfo = null): array
    {
        if (Conf::getConfigValueAsString('gd/layer', 'real') === 'real') {
            // @codeCoverageIgnoreStart
            return getimagesize($fileName, $imageInfo);
            // @codeCoverageIgnoreEnd
        } else {
            self::$imageSize = array_reverse(self::$imageSize);

            $result = array_pop(self::$imageSize);

            self::$imageSize = array_reverse(self::$imageSize);

            return $result;
        }
    }

    /**
     * List of the saved images
     *
     * @var array<string, string>
     */
    public static $savedImages = [];

    /**
     * Method stores image into file
     *
     * @param resource $resource
     *            resource
     * @param string $filePath
     *            path to the saving file
     */
    public static function imageJpeg($resource, string $filePath): void
    {
        if (Conf::getConfigValueAsString('gd/layer', 'real') === 'real') {
            // @codeCoverageIgnoreStart
            imagejpeg($resource, $filePath);
            // @codeCoverageIgnoreEnd
        } else {
            $stream = fopen('php://memory', 'r+');
            imagejpeg($resource, $stream);
            rewind($stream);
            self::$savedImages[$filePath] = stream_get_contents($stream);
        }
    }
    
    /**
     * Method stores image into file
     *
     * @param resource $resource
     *            resource
     * @param string $filePath
     *            path to the saving file
     */
    public static function imagePng($resource, string $filePath): void
    {
        if (Conf::getConfigValueAsString('gd/layer', 'real') === 'real') {
            // @codeCoverageIgnoreStart
            imagepng($resource, $filePath);
            // @codeCoverageIgnoreEnd
        } else {
            $stream = fopen('php://memory', 'r+');
            imagepng($resource, $stream);
            rewind($stream);
            self::$savedImages[$filePath] = stream_get_contents($stream);
        }
    }
    
    /**
     * Method stores image into file
     *
     * @param resource $resource
     *            resource
     * @param string $filePath
     *            path to the saving file
     */
    public static function imageGif($resource, string $filePath): void
    {
        if (Conf::getConfigValueAsString('gd/layer', 'real') === 'real') {
            // @codeCoverageIgnoreStart
            imagegif($resource, $filePath);
            // @codeCoverageIgnoreEnd
        } else {
            $stream = fopen('php://memory', 'r+');
            imagegif($resource, $stream);
            rewind($stream);
            self::$savedImages[$filePath] = stream_get_contents($stream);
        }
    }
    
    /**
     * Method stores image into file
     *
     * @param resource $resource
     *            resource
     * @param string $filePath
     *            path to the saving file
     */
    public static function imageBmp($resource, string $filePath): void
    {
        if (Conf::getConfigValueAsString('gd/layer', 'real') === 'real') {
            // @codeCoverageIgnoreStart
            imagebmp($resource, $filePath);
            // @codeCoverageIgnoreEnd
        } else {
            $stream = fopen('php://memory', 'r+');
            imagebmp($resource, $stream);
            rewind($stream);
            self::$savedImages[$filePath] = stream_get_contents($stream);
        }
    }
    
    /**
     * Method stores image into file
     *
     * @param resource $resource
     *            resource
     * @param string $filePath
     *            path to the saving file
     */
    public static function imageWebp($resource, string $filePath): void
    {
        if (Conf::getConfigValueAsString('gd/layer', 'real') === 'real') {
            // @codeCoverageIgnoreStart
            imagewebp($resource, $filePath);
            // @codeCoverageIgnoreEnd
        } else {
            $stream = fopen('php://memory', 'r+');
            imagewebp($resource, $stream);
            rewind($stream);
            self::$savedImages[$filePath] = stream_get_contents($stream);
        }
    }
}
