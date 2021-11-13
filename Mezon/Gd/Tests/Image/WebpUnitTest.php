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

        $this->assertEquals($expected, InMemory::fileGetContents('./dst'), 'WEBP files are not equal');
    }
}
