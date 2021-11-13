<?php
namespace Mezon\Gd\Tests\Image;

use PHPUnit\Framework\TestCase;
use Mezon\Conf\Conf;
use Mezon\Gd\Layer;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class WebpUnitTest extends TestCase
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
     * Testing method imageWebp
     */
    public function testImageWebp(): void
    {
        // test body
        $resource = imagecreatefromwebp(__DIR__ . '/../Data/test.webp');
        Layer::imageWebp($resource, './dst');

        // assertions

        $origin = imagecreatefromstring(file_get_contents(__DIR__ . '/../Data/test.webp'));
        $stream = fopen('php://memory', 'r+');
        imagewebp($origin, $stream);
        rewind($stream);
        $expected = stream_get_contents($stream);

        $this->assertEquals($expected, Layer::$savedImages['./dst'], 'WEBP files are not equal');
    }
}
