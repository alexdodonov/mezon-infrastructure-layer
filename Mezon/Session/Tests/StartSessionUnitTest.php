<?php
namespace Mezon\Session\Tests;

use PHPUnit\Framework\TestCase;
use Mezon\Session\Layer;
use Mezon\Conf\Conf;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class StartSessionUnitTest extends TestCase
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
     * Testing method startSession
     */
    public function testStartSession(): void
    {
        // setup
        Layer::sessionWriteClose();

        // test body
        $result = Layer::startSession();

        // assertions
        $this->assertTrue($result);
        $this->assertTrue(Layer::wasSessionStarted());
    }

    /**
     * Testing method
     */
    public function testStartSessionMultiple(): void
    {
        // setup
        Layer::sessionWriteClose();

        // test body
        Layer::startSession();
        Conf::setConfigValue('session/layer', 'real');
        $result = Layer::startSession();

        // assertions
        $this->assertTrue($result);
    }
}
