<?php
namespace Mezon\Session\Tests;

use PHPUnit\Framework\TestCase;
use Mezon\Session\Layer;
use Mezon\Conf\Conf;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class StartWriteCloseUnitTest extends TestCase
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
     * Testing method sessionWriteClose
     */
    public function testSessionWriteClose(): void
    {
        // setup
        Layer::startSession();

        // test body
        $result = Layer::sessionWriteClose();

        // assertions
        $this->assertTrue($result);
        $this->assertFalse(Layer::wasSessionStarted());
    }
}
