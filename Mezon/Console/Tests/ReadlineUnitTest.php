<?php
namespace Mezon\Console\Tests;

use PHPUnit\Framework\TestCase;
use Mezon\Conf\Conf;
use Mezon\Console\Layer;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class ReadlineUnitTest extends TestCase
{

    /**
     *
     * {@inheritdoc}
     * @see TestCase::setUp()
     */
    protected function setUp(): void
    {
        Layer::$readlines = [];
        Conf::setConfigValue('console/layer', 'mock');
    }

    /**
     * Testing method readline
     */
    public function testReadline(): void
    {
        // setup
        Layer::$readlines [] = 'console input 1';
        Layer::$readlines [] = 'console input 2';
        Layer::$readlines [] = 'console input 3';
        
        // test body and assertions
        ob_start();
        $this->assertEquals('console input 1', Layer::readline());
        $this->assertEquals('console input 2', Layer::readline());
        $this->assertEquals('console input 3', Layer::readline('prompt'));
        $result = ob_get_contents();
        ob_end_clean();
        $this->assertEquals('prompt', $result);
    }
}
