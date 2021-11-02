<?php
namespace Mezon\Session\Tests;

use PHPUnit\Framework\TestCase;
use Mezon\Session\Layer;
use Mezon\Conf\Conf;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class SessionNameUnitTest extends TestCase
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
     * Testing method sessionName
     */
    public function testSessionName() : void
    {
        // setup
        Layer::sessionWriteClose();
        
        // test body
        $result = Layer::sessionName();
        
        // assertions
        $this->assertEquals('session-name', $result);
    }
}
