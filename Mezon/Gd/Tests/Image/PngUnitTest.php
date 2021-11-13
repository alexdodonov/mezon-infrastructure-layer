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
class PngUnitTest extends TestCase
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
     * Testing method imagePng
     */
    public function testImagePng(): void
    {
        // test body
        $resource = imagecreatefrompng(__DIR__ . '/../Data/test.png');
        Layer::imagePng($resource, './dst');

        // assertions
        $origin = imagecreatefromstring(file_get_contents(__DIR__ . '/../Data/test.png'));
        $stream = fopen('php://memory', 'r+');
        imagepng($origin, $stream);
        rewind($stream);
        $expected = stream_get_contents($stream);

        $this->assertEquals($expected, InMemory::fileGetContents('./dst'), 'PNG files are not equal');
    }
}
