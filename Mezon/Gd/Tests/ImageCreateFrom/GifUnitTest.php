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
class GifUnitTest extends TestCase
{
    
    /**
     * Testing method imageCreateFromGif
     */
    public function testImageCreateFromGif(): void
    {
        // setup
        Conf::setConfigValue('gd/layer', 'real');

        // test body
        $resource = Layer::imageCreateFromGif(__DIR__ . '/../Data/test.gif');

        // assertions
        $this->assertNotFalse($resource);
        $this->assertEquals(32, imagesx($resource));
        $this->assertEquals(32, imagesy($resource));
    }

    /**
     * Testing method imageCreateFromGif
     */
    public function testImageCreateFromGifMock(): void
    {
        // setup
        Conf::setConfigValue('gd/layer', 'mock');
        InMemory::preloadFile(__DIR__ . '/../Data/test.gif');

        // test body
        $resource = Layer::imageCreateFromGif(__DIR__ . '/../Data/test.gif');

        // assertions
        $this->assertNotFalse($resource);
        $this->assertEquals(32, imagesx($resource));
        $this->assertEquals(32, imagesy($resource));
    }
}
