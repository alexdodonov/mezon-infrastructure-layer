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
class PngUnitTest extends TestCase
{

    /**
     * Testing method imageCreateFromPng
     */
    public function testImageCreateFromPng(): void
    {
        // setup
        Conf::setConfigValue('gd/layer', 'real');

        // test body
        $resource = Layer::imageCreateFromPng(__DIR__ . '/../Data/test.png');

        // assertions
        $this->assertNotFalse($resource);
        $this->assertEquals(32, imagesx($resource));
        $this->assertEquals(32, imagesy($resource));
    }

    /**
     * Testing method imageCreateFromPng
     */
    public function testImageCreateFromPngMock(): void
    {
        // setup
        Conf::setConfigValue('gd/layer', 'mock');
        InMemory::preloadFile(__DIR__ . '/../Data/test.png');

        // test body
        $resource = Layer::imageCreateFromPng(__DIR__ . '/../Data/test.png');

        // assertions
        $this->assertNotFalse($resource);
        $this->assertEquals(32, imagesx($resource));
        $this->assertEquals(32, imagesy($resource));
    }
}
