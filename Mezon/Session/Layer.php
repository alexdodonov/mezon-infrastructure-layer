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
            // @codeCoverageIgnoreStart
            if (self::$sessionWasStarted) {
                return true;
            } else {
                return self::$sessionWasStarted = session_start();
            }
            // @codeCoverageIgnoreEnd
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
            // @codeCoverageIgnoreStart
            return session_name();
            // @codeCoverageIgnoreEnd
        } else {
            return 'session-name';
        }
    }

    /**
     * Method sets cookie
     *
     * @param string $name
     *            cookie name
     * @param string $value
     *            cookie value
     * @param int $expires
     *            expires
     * @param string $path
     *            paht of the cookie
     * @param string $domain
     *            domain
     * @param bool $secure
     *            secure?
     * @param bool $httponly
     *            http only?
     * @return bool true on success, false otherwise
     */
    public static function setCookie(
        string $name,
        string $value = "",
        int $expires = 0,
        string $path = "",
        string $domain = "",
        bool $secure = false,
        bool $httponly = false): bool
    {
        if (Conf::getConfigValue('session/layer', 'real') === 'real') {
            // @codeCoverageIgnoreStart
            return setcookie($name, $value, $expires, $path, $domain, $secure, $httponly);
            // @codeCoverageIgnoreEnd
        } else {
            return true;
        }
    }

    /**
     * Method setups session id
     *
     * @param string $id
     *            id of the session
     * @return string session's name
     */
    public static function sessionId(string $id = ''): string
    {
        if (Conf::getConfigValue('session/layer', 'real') === 'real') {
            // @codeCoverageIgnoreStart
            return session_id($id);
            // @codeCoverageIgnoreEnd
        } else {
            return 'session-id';
        }
    }

    /**
     * Write session data and end session
     *
     * @return bool true on success or false on failure
     */
    public static function sessionWriteClose(): bool
    {
        self::$sessionWasStarted = false;

        if (Conf::getConfigValue('session/layer', 'real') === 'real') {
            // @codeCoverageIgnoreStart
            return session_write_close();
            // @codeCoverageIgnoreEnd
        } else {
            return true;
        }
    }

    // TODO make article for dev.to about this abstraction
}
