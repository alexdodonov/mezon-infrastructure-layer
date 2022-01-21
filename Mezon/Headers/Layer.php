<?php
namespace Mezon\Headers;

use Mezon\Conf\Conf;
use function Safe\getallheaders;

/**
 * HTTP headers abstractions
 *
 * @package InfrastructureLayer
 * @subpackage Headers
 * @author Dodonov A.A.
 * @version v.1.0 (2022/01/16)
 * @copyright Copyright (c) 2022, http://aeon.su
 */
class Layer
{

    /**
     * Request headers
     *
     * @var array
     */
    private static $headers = [];

    /**
     * Method returns list of headers
     *
     * @return array list of headers
     */
    public static function getAllHeaders(): array
    {
        if (Conf::getConfigValueAsString('headers/layer', 'real') === 'real') {
            // @codeCoverageIgnoreStart
            return getallheaders();
            // @codeCoverageIgnoreEnd
        } else {
            return self::$headers;
        }
    }

    /**
     * Method sets headers for testing purposes
     *
     * @param array $headers
     *            headers
     */
    public static function setAllHeaders(array $headers): void
    {
        self::$headers = $headers;
    }
}
