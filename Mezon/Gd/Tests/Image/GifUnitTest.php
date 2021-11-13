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

        $this->assertEquals($expected, InMemory::fileGetContents('./dst'), 'GIF files are not equal');
    }
}
