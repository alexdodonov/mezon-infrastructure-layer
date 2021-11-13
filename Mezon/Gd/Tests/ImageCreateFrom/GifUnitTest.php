<?php
namespace Mezon\Gd\Tests\ImageCreateFrom;

use PHPUnit\Framework\TestCase;
use Mezon\Conf\Conf;
use Mezon\Gd\Layer;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class GifUnitTest extends TestCase
{

    /**
     *
     * {@inheritdoc}
     * @see TestCase::setUp()
     */
    protected function setUp(): void
    {
        Conf::setConfigValue('gd/layer', 'mock');
        Layer::$imagesCreateFromFile = [];
    }

    /**
     * Testing method imageCreateFromGif
     */
    public function testImageCreateFromGif(): void
    {
        // setup
        Layer::$imagesCreateFromFile['file'] = file_get_contents(__DIR__ . '/../Data/test.gif');

        // test body
        $resource = Layer::imageCreateFromGif('file');

        // assertions
        $this->assertNotFalse($resource);
        $this->assertEquals(32, imagesx($resource));
        $this->assertEquals(32, imagesy($resource));
    }
}
