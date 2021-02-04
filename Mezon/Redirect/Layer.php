<?php
namespace Mezon\Redirect;

use Mezon\Conf\Conf;

class Layer
{

    /**
     * Was redirect performed?
     *
     * @var boolean
     */
    public static $redirectWasPerformed = false;

    /**
     * Redirecting to another page
     */
    public static function redirectTo(string $url): void
    {
        if (Conf::getConfigValue('redirect/layer', 'real') === 'real') {
            header("Location: $url");
            exit(0);
        } else {
            self::$redirectWasPerformed = true;
        }
    }

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
        if (Conf::getConfigValue('redirect/layer', 'real') === 'real') {
            if (! self::$sessionWasStarted) {
                return self::$sessionWasStarted = session_start();
            }
        } else {
            self::$sessionWasStarted = true;
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
}
