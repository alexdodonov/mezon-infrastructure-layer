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
        if (Conf::getConfigValue('gd/layer', 'real') === 'real') {
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
}
