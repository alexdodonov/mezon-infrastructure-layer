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
class BmpUnitTest extends TestCase
{

    /**
     * Testing method imageCreateFromBmp
     */
    public function testImageCreateFromBmp(): void
    {
        // setup
        Conf::setConfigValue('gd/layer', 'real');

        // test body
        $resource = Layer::imageCreateFromBmp(__DIR__ . '/../Data/test.bmp');

        // assertions
        $this->assertNotFalse($resource);
        $this->assertEquals(32, imagesx($resource));
        $this->assertEquals(32, imagesy($resource));
    }

    /**
     * Testing method imageCreateFromBmp
     */
    public function testImageCreateFromBmpMock(): void
    {
        // setup
        Conf::setConfigValue('gd/layer', 'mock');
        InMemory::preloadFile(__DIR__ . '/../Data/test.bmp');

        // test body
        $resource = Layer::imageCreateFromBmp(__DIR__ . '/../Data/test.bmp');

        // assertions
        $this->assertNotFalse($resource);
        $this->assertEquals(32, imagesx($resource));
        $this->assertEquals(32, imagesy($resource));
    }
}
