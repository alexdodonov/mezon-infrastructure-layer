<?php
namespace Mezon\Fs\Tests;

use PHPUnit\Framework\TestCase;
use Mezon\Conf\Conf;
use Mezon\Fs\Layer;
use Mezon\Fs\InMemory;

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
        Conf::setConfigValue('fs/layer', 'mock');
        InMemory::clearFs();
    }

    /**
     * Testing method filePutContents
     */
    public function testFilePutContentsWithAllParameters(): void
    {
        // test body
        Layer::filePutContents('./path-a', 'a', FILE_APPEND);
        Layer::filePutContents('./path-a', 'b', FILE_APPEND);

        // assertions
        $this->assertEquals('ab', InMemory::fileGetContents('./path-a'));
    }

    /**
     * Testing method filePutContents with default parameters
     */
    public function testFilePutContentsWithDefaultParameters(): void
    {
        // test body
        Layer::filePutContents('./path-d', 'a');
        Layer::filePutContents('./path-d', 'b');

        // assertions
        $this->assertEquals('b', InMemory::fileGetContents('./path-d'));
    }
}
