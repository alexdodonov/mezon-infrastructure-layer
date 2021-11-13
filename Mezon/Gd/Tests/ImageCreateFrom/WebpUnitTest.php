<?php
namespace Mezon\Gd\Tests\ImageCreateFrom;

use PHPUnit\Framework\TestCase;
use Mezon\Conf\Conf;
use Mezon\Gd\Layer;
use Mezon\Fs\InMemory;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class WebpUnitTest extends TestCase
{

    /**
     * Testing method imageCreateFromWebp
     */
    public function testImageCreateFromWebp(): void
    {
        // setup
        Conf::setConfigValue('gd/layer', 'real');

        // test body
        $resource = Layer::imageCreateFromWebp(__DIR__ . '/../Data/test.webp');

        // assertions
        $this->assertNotFalse($resource);
        $this->assertEquals(32, imagesx($resource));
        $this->assertEquals(32, imagesy($resource));
    }

    /**
     * Testing method imageCreateFromWebp
     */
    public function testImageCreateFromWebpMock(): void
    {
        // setup
        Conf::setConfigValue('gd/layer', 'mock');
        InMemory::preloadFile(__DIR__ . '/../Data/test.webp');

        // test body
        $resource = Layer::imageCreateFromWebp(__DIR__ . '/../Data/test.webp');

        // assertions
        $this->assertNotFalse($resource);
        $this->assertEquals(32, imagesx($resource));
        $this->assertEquals(32, imagesy($resource));
    }
}
