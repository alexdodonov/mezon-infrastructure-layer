<?php
namespace Mezon\Console;

use Mezon\Conf\Conf;

/**
 * Configuration routines
 *
 * @package InfrastructureLayer
 * @subpackage Console
 * @author Dodonov A.A.
 * @version v.1.0 (2021/12/17)
 * @copyright Copyright (c) 2021, http://aeon.su
 */
class Layer
{

    /**
     * Returns for readline method
     *
     * @var string[]
     */
    public static $readlines = [];

    /**
     * Reading string from console
     *
     * @param ?string $prompt
     *            prompt message
     * @return string readed line
     */
    public static function readline(?string $prompt = null): string
    {
        if (Conf::getConfigValueAsString('console/layer', 'real') === 'real') {
            // @codeCoverageIgnoreStart
            return readline($prompt);
            // @codeCoverageIgnoreEnd
        } else {
            self::$readlines = array_reverse(self::$readlines);

            $result = array_pop(self::$readlines);// TODO use array_shift

            self::$readlines = array_reverse(self::$readlines);

            print($prompt);

            return $result;
        }
    }
}
