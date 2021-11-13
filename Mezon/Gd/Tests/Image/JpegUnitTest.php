<?php
namespace Mezon\Gd\Tests\Image;

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
     *
     * {@inheritdoc}
     * @see TestCase::setUp()
     */
    protected function setUp(): void
    {
        Conf::setConfigValue('gd/layer', 'mock');
    }

    /**
     * Testing method imageJpeg
     */
    public function testImageJpeg(): void
    {
        // test body
        $resource = imagecreatefromjpeg(__DIR__ . '/../Data/test.jpg');
        Layer::imageJpeg($resource, './dst');

        // assertions
        $origin = imagecreatefromstring(file_get_contents(__DIR__ . '/../Data/test.jpg'));
        $stream = fopen('php://memory', 'r+');
        imagejpeg($origin, $stream);
        rewind($stream);
        $expected = stream_get_contents($stream);

        $this->assertEquals($expected, InMemory::fileGetContents('./dst'), 'JPEG files are not equal');
    }
}
