<?php
namespace Mezon\Gd\Tests\ImageCreateFrom;

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
        Layer::$imagesCreateFromFile = [];
    }

    /**
     * Testing method imageCreateFromWebp
     */
    public function testImageCreateFromWebp(): void
    {
        // setup
        Layer::$imagesCreateFromFile['file'] = file_get_contents(__DIR__ . '/../Data/test.webp');

        // test body
        $resource = Layer::imageCreateFromWebp('file');

        // assertions
        $this->assertNotFalse($resource);
        $this->assertEquals(32, imagesx($resource));
        $this->assertEquals(32, imagesy($resource));
    }
}
