<?php
namespace Mezon\Session;

use Mezon\Conf\Conf;

class Layer
{

    /**
     * Was the session started
     *
     * @var boolean
     */
    private static $sessionWasStarted = false;

    /**
     * Method starts session
     *
     * @return bool true if the session was started, false otherwise
     */
    public static function startSession(): bool
    {
        if (Conf::getConfigValue('session/layer', 'real') === 'real') {
            if (self::$sessionWasStarted) {
                return true;
            } else {
                return self::$sessionWasStarted = session_start();
            }
        } else {
            return self::$sessionWasStarted = true;
        }
    }

    /**
     * Method returns information was the session started
     *
     * @return bool true if the session was started, false otherwise.
     */
    public static function wasSessionStarted(): bool
    {
        return self::$sessionWasStarted;
    }

    /**
     * Method returns session's name
     *
     * @return string session's name
     */
    public static function sessionName(): string
    {
        if (Conf::getConfigValue('session/layer', 'real') === 'real') {
            return session_name();
        } else {
            return 'session-name';
        }
    }
}
