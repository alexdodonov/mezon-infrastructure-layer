<?php
namespace Mezon\System;

use Mezon\Conf\Conf;

/**
 * Configuration routines
 *
 * @package InfrastructureLayer
 * @subpackage System
 * @author Dodonov A.A.
 * @version v.1.0 (2022/01/21)
 * @copyright Copyright (c) 2022, http://aeon.su
 */
class Layer
{

    /**
     * Was the method 'die' called
     *
     * @var boolean
     */
    public static $dieWasCalled = false;

    /**
     * Method starts session
     *
     * @return bool true if the session was started, false otherwise
     */
    public static function die(): bool
    {
        if (Conf::getConfigValueAsString('system/layer', 'real') === 'real') {
            // @codeCoverageIgnoreStart
            die();
            // @codeCoverageIgnoreEnd
        } else {
            return self::$dieWasCalled = true;
        }
    }
}
