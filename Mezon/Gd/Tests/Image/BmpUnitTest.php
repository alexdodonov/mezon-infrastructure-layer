<?php
namespace Mezon\Gd\Tests\Image;

use PHPUnit\Framework\TestCase;
use Mezon\Conf\Conf;
use Mezon\Gd\Layer;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class BmpUnitTest extends TestCase
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
     * Testing method imageBmp
     */
    public function testImageBmp(): void
    {
        // test body
        $resource = imagecreatefrombmp(__DIR__ . '/../Data/test.bmp');
        Layer::imageBmp($resource, './dst');

        // assertions

        $origin = imagecreatefromstring(file_get_contents(__DIR__ . '/../Data/test.bmp'));
        $stream = fopen('php://memory', 'r+');
        imagebmp($origin, $stream);
        rewind($stream);
        $expected = stream_get_contents($stream);

        $this->assertEquals($expected, Layer::$savedImages['./dst'], 'BMP files are not equal');
    }
}
