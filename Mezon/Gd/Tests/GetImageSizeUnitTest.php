<?php
namespace Mezon\Gd\Tests;

use PHPUnit\Framework\TestCase;
use Mezon\Gd\Layer;
use Mezon\Conf\Conf;
use Mezon\Fs\InMemory;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class GetImageSizeUnitTest extends TestCase
{

    /**
     *
     * {@inheritdoc}
     * @see TestCase::setUp()
     */
    protected function setUp(): void
    {
        InMemory::clearFs();
    }

    /**
     * Testing data provider
     *
     * @return array testing data
     */
    public function getImageSizeDataProvider(): array
    {
        return [
            // #0
            [
                'test.bmp',
                'image/bmp'
            ],
            // #1
            [
                'test.gif',
                'image/gif'
            ],
            // #2
            [
                'test.jpg',
                'image/jpeg'
            ],
            // #3
            [
                'test.png',
                'image/png'
            ],
            // #4
            [
                'test.webp',
                'image/webp'
            ]
        ];
    }

    /**
     * Testing method getImageSize with real brunch
     *
     * @param string $fileName
     *            name of the loading file
     * @param string $mime
     *            mime type of the file
     * @dataProvider getImageSizeDataProvider
     */
    public function testGetImageSize(string $fileName, string $mime): void
    {
        // setup
        Conf::setConfigValue('gd/layer', 'real');

        // test body
        $result = Layer::getImageSize(__DIR__ . '/Data/' . $fileName);

        // assertions
        $this->assertEquals(32, $result[0]);
        $this->assertEquals(32, $result[1]);
        $this->assertEquals($mime, $result['mime']);
    }

    /**
     * Testing method getImageSize with mock brunch
     *
     * @param string $fileName
     *            name of the loading file
     * @param string $mime
     *            mime type of the file
     * @dataProvider getImageSizeDataProvider
     */
    public function testGetImageSizeMock(string $fileName, string $mime): void
    {
        // setup
        Conf::setConfigValue('gd/layer', 'mock');
        InMemory::preloadFile(__DIR__ . '/Data/' . $fileName);

        // test body
        $result = Layer::getImageSize(__DIR__ . '/Data/' . $fileName);

        // assertions
        $this->assertEquals(32, $result[0]);
        $this->assertEquals(32, $result[1]);
        $this->assertEquals($mime, $result['mime']);
    }
}
