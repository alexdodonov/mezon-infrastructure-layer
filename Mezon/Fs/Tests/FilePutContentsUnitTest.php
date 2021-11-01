<?php
namespace Mezon\Fs\Tests;

use PHPUnit\Framework\TestCase;
use Mezon\Conf\Conf;
use Mezon\Fs\Layer;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class FilePutContentsUnitTest extends TestCase
{

    /**
     *
     * {@inheritdoc}
     * @see TestCase::setUp()
     */
    protected function setUp(): void
    {
        Layer::clearFilePutContentsData();
        Layer::clearCreatedDirectoriesInfo();
        Conf::setConfigValue('fs/layer', 'mock');
    }

    /**
     * Testing method filePutContents
     */
    public function testFilePutContentsWithAllParameters(): void
    {
        // test body
        $result = Layer::filePutContents('./path-a', 'data-a', 1);

        // assertions
        $this->assertEquals(1, $result);
        $this->assertEquals(Layer::$filePaths[0], './path-a');
        $this->assertEquals(Layer::$fileData[0], 'data-a');
        $this->assertEquals(Layer::$fileFlags[0], 1);
    }

    /**
     * Testing method filePutContents with default parameters
     */
    public function testFilePutContentsWithDefaultParameters(): void
    {
        // test body
        $result = Layer::filePutContents('./path-d', 'data-d');

        // assertions
        $this->assertEquals(1, $result);
        $this->assertEquals(Layer::$filePaths[0], './path-d');
        $this->assertEquals(Layer::$fileData[0], 'data-d');
        $this->assertEquals(Layer::$fileFlags[0], 0);
    }
}
