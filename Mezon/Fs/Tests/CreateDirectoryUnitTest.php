<?php
namespace Mezon\Fs\Tests;

use PHPUnit\Framework\TestCase;
use Mezon\Conf\Conf;
use Mezon\Fs\Layer;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class CreateDirectoryUnitTest extends TestCase
{

    /**
     *
     * {@inheritdoc}
     * @see TestCase::setUp()
     */
    protected function setUp(): void
    {
        Layer::clearCreatedDirectoriesInfo();
        Conf::setConfigValue('fs/layer', 'mock');
    }

    /**
     * Testing method createDirectory
     */
    public function testCreateDirectory(): void
    {
        // test body
        $result = Layer::createDirectory('/path', 0666, false);

        // assertions
        $this->assertEquals('/path', Layer::getCreatedDirectoryInfo(0)['path']);
        $this->assertEquals(0666, Layer::getCreatedDirectoryInfo(0)['mode']);
        $this->assertEquals(false, Layer::getCreatedDirectoryInfo(0)['recursive']);
        $this->assertTrue($result);
    }

    /**
     * Testing method createDirectory with default parameters
     */
    public function testCreateDirectoryWithDefaultParameters(): void
    {
        // test body
        $result = Layer::createDirectory('/path');

        // assertions
        $this->assertEquals('/path', Layer::getCreatedDirectoryInfo(0)['path']);
        $this->assertEquals(0777, Layer::getCreatedDirectoryInfo(0)['mode']);
        $this->assertEquals(false, Layer::getCreatedDirectoryInfo(0)['recursive']);
        $this->assertTrue($result);
    }
}
