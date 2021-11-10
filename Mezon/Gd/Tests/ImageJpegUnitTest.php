<?php
namespace Mezon\Gd\Tests;

use PHPUnit\Framework\TestCase;
use Mezon\Conf\Conf;
use Mezon\Gd\Layer;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class ImageJpegUnitTest extends TestCase
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
     * Testing method imageJpeg
     */
    public function testImageJpeg(): void
    {
        // test body
        $resource = imagecreatefromjpeg(__DIR__ . '/Data/test.jpg');
        Layer::imageJpeg($resource, './dst');

        // assertions

        $origin = imagecreatefromstring(file_get_contents(__DIR__ . '/Data/test.jpg'));
        $stream = fopen('php://memory', 'r+');
        imagejpeg($origin, $stream);
        rewind($stream);
        $expected = stream_get_contents($stream);

        $this->assertEquals($expected, Layer::$savedImages['./dst'], 'JPEG files are not equal');
    }
}
