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
        Layer::$cookies = [];
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

    /**
     * Testing method setCookie with default parameters
     */
    public function testSetCookieWithDefaultParameters(): void
    {
        // test body
        Layer::setCookie('default-cookie');

        // assertions
        $this->assertEquals('default-cookie', Layer::$cookies[0]['name']);
        $this->assertEquals('', Layer::$cookies[0]['value']);
        $this->assertEquals(0, Layer::$cookies[0]['expires']);
        $this->assertEquals('', Layer::$cookies[0]['path']);
        $this->assertEquals('', Layer::$cookies[0]['domain']);
        $this->assertEquals(false, Layer::$cookies[0]['secure']);
        $this->assertEquals(false, Layer::$cookies[0]['httponly']);
    }
}
