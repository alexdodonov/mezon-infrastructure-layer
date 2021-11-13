<?php
namespace Mezon\Gd;

use Mezon\Conf\Conf;
use Mezon\Fs\InMemory;

/**
 * Configuration routines
 *
 * @package InfrastructureLayer
 * @subpackage Gd
 * @author Dodonov A.A.
 * @version v.1.0 (2021/11/13)
 * @copyright Copyright (c) 2021, aeon.org
 */
class Layer
{

    /**
     * Method returns image size
     *
     * @param string $filePath
     *            path to the image size
     * @param array $imageInfo
     *            image info
     * @return array image sizes
     */
    public static function getImageSize(string $filePath, array &$imageInfo = null): array
    {
        if (Conf::getConfigValueAsString('gd/layer', 'real') === 'real') {
            return getimagesize($filePath, $imageInfo);
        } else {
            $image = imagecreatefromstring(InMemory::existingFileGetContents($filePath));

            $mime = (new \finfo(FILEINFO_MIME_TYPE))->buffer(InMemory::existingFileGetContents($filePath));
            
            $mime = $mime === 'image/x-ms-bmp' ? 'image/bmp' : $mime;
            
            return [
                0 => imagesx($image),
                1 => imagesy($image),
                'mime' => $mime
            ];
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
            InMemory::filePutContents($filePath, stream_get_contents($stream));
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
            InMemory::filePutContents($filePath, stream_get_contents($stream));
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
            InMemory::filePutContents($filePath, stream_get_contents($stream));
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
            InMemory::filePutContents($filePath, stream_get_contents($stream));
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
            InMemory::filePutContents($filePath, stream_get_contents($stream));
        }
    }

    /**
     * Creating image from file
     *
     * @param string $filePath
     *            path to the file
     * @return false|resource created image
     */
    public static function imageCreateFromJpeg(string $filePath)
    {
        if (Conf::getConfigValueAsString('gd/layer', 'real') === 'real') {
            return imagecreatefromjpeg($filePath);
        } else {
            return imagecreatefromstring(InMemory::existingFileGetContents($filePath));
        }
    }

    /**
     * Creating image from file
     *
     * @param string $filePath
     *            path to the file
     * @return false|resource created image
     */
    public static function imageCreateFromPng(string $filePath)
    {
        if (Conf::getConfigValueAsString('gd/layer', 'real') === 'real') {
            return imagecreatefrompng($filePath);
        } else {
            return imagecreatefromstring(InMemory::existingFileGetContents($filePath));
        }
    }

    /**
     * Creating image from file
     *
     * @param string $filePath
     *            path to the file
     * @return false|resource created image
     */
    public static function imageCreateFromGif(string $filePath)
    {
        if (Conf::getConfigValueAsString('gd/layer', 'real') === 'real') {
            return imagecreatefromgif($filePath);
        } else {
            return imagecreatefromstring(InMemory::existingFileGetContents($filePath));
        }
    }

    /**
     * Creating image from file
     *
     * @param string $filePath
     *            path to the file
     * @return false|resource created image
     */
    public static function imageCreateFromBmp(string $filePath)
    {
        if (Conf::getConfigValueAsString('gd/layer', 'real') === 'real') {
            return imagecreatefrombmp($filePath);
        } else {
            return imagecreatefromstring(InMemory::existingFileGetContents($filePath));
        }
    }

    /**
     * Creating image from file
     *
     * @param string $filePath
     *            path to the file
     * @return false|resource created image
     */
    public static function imageCreateFromWebp(string $filePath)
    {
        if (Conf::getConfigValueAsString('gd/layer', 'real') === 'real') {
            return imagecreatefromwebp($filePath);
        } else {
            return imagecreatefromstring(InMemory::existingFileGetContents($filePath));
        }
    }
}
