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
class JpegUnitTest extends TestCase
{

    /**
     * Testing method imageCreateFromJpeg
     */
    public function testImageCreateFromJpeg(): void
    {
        // setup
        Conf::setConfigValue('gd/layer', 'real');

        // test body
        $resource = Layer::imageCreateFromJpeg(__DIR__ . '/../Data/test.jpg');

        // assertions
        $this->assertNotFalse($resource);
        $this->assertEquals(32, imagesx($resource));
        $this->assertEquals(32, imagesy($resource));
    }

    /**
     * Testing method imageCreateFromJpeg
     */
    public function testImageCreateFromJpegMock(): void
    {
        // setup
        Conf::setConfigValue('gd/layer', 'mock');
        InMemory::preloadFile(__DIR__ . '/../Data/test.jpg');

        // test body
        $resource = Layer::imageCreateFromJpeg(__DIR__ . '/../Data/test.jpg');

        // assertions
        $this->assertNotFalse($resource);
        $this->assertEquals(32, imagesx($resource));
        $this->assertEquals(32, imagesy($resource));
    }
}
