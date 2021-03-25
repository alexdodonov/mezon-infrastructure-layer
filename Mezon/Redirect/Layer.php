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
     * Last redirection URL
     * 
     * @var string
     */
    public static $lastRedirectionUrl = '';

    /**
     * Redirecting to another page
     */
    public static function redirectTo(string $url): void
    {
        self::$lastRedirectionUrl = $url;
        
        if (Conf::getConfigValue('redirect/layer', 'real') === 'real') {
            header("Location: $url");
            exit(0);
        } else {
            self::$redirectWasPerformed = true;
        }
    }
}
