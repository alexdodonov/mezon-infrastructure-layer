<?php
namespace Mezon\Gd\Tests\Image;

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
        Layer::$savedImages = [];
    }

    /**
     * Testing method imageGif
     */
    public function testImageGif(): void
    {
        // test body
        $resource = imagecreatefromgif(__DIR__ . '/../Data/test.gif');
        Layer::imageGif($resource, './dst');

        // assertions

        $origin = imagecreatefromstring(file_get_contents(__DIR__ . '/../Data/test.gif'));
        $stream = fopen('php://memory', 'r+');
        imagegif($origin, $stream);
        rewind($stream);
        $expected = stream_get_contents($stream);

        $this->assertEquals($expected, Layer::$savedImages['./dst'], 'GIF files are not equal');
    }
}
