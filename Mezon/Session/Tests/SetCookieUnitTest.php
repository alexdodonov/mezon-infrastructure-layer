<?php
namespace Mezon\Session\Tests;

use PHPUnit\Framework\TestCase;
use Mezon\Session\Layer;
use Mezon\Conf\Conf;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class SetCookieUnitTest extends TestCase
{

    /**
     *
     * {@inheritdoc}
     * @see TestCase::setUp()
     */
    protected function setUp(): void
    {
        Conf::setConfigValue('session/layer', 'mock');
    }

    /**
     * Testing method setCookie
     */
    public function testSetCookie(): void
    {
        // test body
        $result = Layer::setCookie('cookie');

        // assertions
        $this->assertTrue($result);
    }
}
