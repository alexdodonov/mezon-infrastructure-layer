<?php
namespace Mezon\Gd\Tests;

use PHPUnit\Framework\TestCase;
use Mezon\Conf\Conf;
use Mezon\Gd\Layer;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class ImagePngUnitTest extends TestCase
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
     * Testing method imagePng
     */
    public function testImagePng(): void
    {
        // test body
        $resource = imagecreatefrompng(__DIR__ . '/Data/test.png');
        Layer::imagePng($resource, './dst');

        // assertions

        $origin = imagecreatefromstring(file_get_contents(__DIR__ . '/Data/test.png'));
        $stream = fopen('php://memory', 'r+');
        imagepng($origin, $stream);
        rewind($stream);
        $expected = stream_get_contents($stream);

        $this->assertEquals($expected, Layer::$savedImages['./dst'], 'PNG files are not equal');
    }
}
