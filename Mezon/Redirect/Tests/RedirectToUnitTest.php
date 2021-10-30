<?php
namespace Mezon\Redirect\Tests;

use PHPUnit\Framework\TestCase;
use Mezon\Conf\Conf;
use Mezon\Redirect\Layer;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class RedirectToUnitTest extends TestCase
{

    /**
     *
     * {@inheritdoc}
     * @see TestCase::setUp()
     */
    protected function setUp(): void
    {
        Conf::setConfigValue('redirect/layer', 'mock');
        Layer::$lastRedirectionUrl = '';
        Layer::$redirectWasPerformed = false;
    }

    /**
     * Testing method redirectTo
     */
    public function testRedirectTo(): void
    {
        // test body
        Layer::redirectTo('url');

        // assertions
        $this->assertEquals('url', Layer::$lastRedirectionUrl);
        $this->assertTrue(Layer::$redirectWasPerformed);
    }
}
