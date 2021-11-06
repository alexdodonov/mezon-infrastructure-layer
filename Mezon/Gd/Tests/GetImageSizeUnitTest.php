<?php
namespace Mezon\Gd\Tests;

use PHPUnit\Framework\TestCase;
use Mezon\Gd\Layer;
use Mezon\Conf\Conf;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class GetImageSizeUnitTest extends TestCase
{

    /**
     * Testing method
     */
    public function testGetImageSize(): void
    {
        // setup
        Conf::setConfigValue('gd/layer', 'mock');
        Layer::$imageSize = [
            [
                1,
                2
            ],
            [
                2,
                3
            ],
            [
                3,
                4
            ]
        ];

        // test body
        $result1 = Layer::getImageSize('./file-path');
        $result2 = Layer::getImageSize('./file-path');

        // assertions
        $this->assertEquals(1, $result1[0]);
        $this->assertEquals(2, $result1[1]);

        $this->assertEquals(2, $result2[0]);
        $this->assertEquals(3, $result2[1]);
    }
}
