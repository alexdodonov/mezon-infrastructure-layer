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
class ExistingFileGetContentsUnitTest extends TestCase
{

    /**
     *
     * {@inheritdoc}
     * @see TestCase::setUp()
     */
    protected function setUp(): void
    {
        Conf::setConfigValue('fs/layer', 'mock');
    }

    /**
     * Testing method existingFileGetContents
     */
    public function testExistingFileGetContents(): void
    {
        // setup
        InMemory::filePutContents('existing', 'data');

        // test body and assertions
        $this->assertEquals('data', Layer::existingFileGetContents('existing'));
    }

    /**
     * Testing exception while getting existing file
     */
    public function testExceptionWhileGettingFileContent(): void
    {
        // assertions
        $this->expectException(\Exception::class);
        $this->expectExceptionCode(- 1);
        $this->expectExceptionMessage('File unexisting does not exists');

        // setup
        InMemory::clearFs();

        // test body
        Layer::existingFileGetContents('unexisting');
    }
}
