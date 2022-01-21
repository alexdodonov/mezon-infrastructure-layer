<?php
namespace Mezon\System\Tests;

use PHPUnit\Framework\TestCase;
use Mezon\Conf\Conf;
use Mezon\System\Layer;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class DieToUnitTest extends TestCase
{

    /**
     *
     * {@inheritdoc}
     * @see TestCase::setUp()
     */
    protected function setUp(): void
    {
        Conf::setConfigValue('system/layer', 'mock');
        Layer::$dieWasCalled = false;
    }

    /**
     * Testing method redirectTo
     */
    public function testRedirectTo(): void
    {
        // test body
        Layer::die();

        // assertions
        $this->assertTrue(Layer::$dieWasCalled);
    }
}
