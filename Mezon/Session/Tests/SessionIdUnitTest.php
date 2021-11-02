<?php
namespace Mezon\Session\Tests;

use PHPUnit\Framework\TestCase;
use Mezon\Session\Layer;
use Mezon\Conf\Conf;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class SessionIdUnitTest extends TestCase
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
     * Testing method sessionId
     */
    public function testSessionId(): void
    {
        // test body
        $result = Layer::sessionId();

        // assertions
        $this->assertEquals('session-id', $result);
    }
}
