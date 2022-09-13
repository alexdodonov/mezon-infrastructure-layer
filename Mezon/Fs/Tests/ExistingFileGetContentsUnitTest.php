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
     * Testing method existingFileGetContents
     */
    public function testExistingFileGetContents(): void
    {
        // setup
        Conf::setConfigValue('fs/layer', 'mock');
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
        Conf::setConfigValue('fs/layer', 'mock');
        InMemory::clearFs();

        // test body
        Layer::existingFileGetContents('unexisting');
    }

    /**
     * Testing method existingFileGetContents for real FS
     */
    public function testExistingFileGetContentsReal(): void
    {
        // setup
        Conf::setConfigValue('fs/layer', 'real');

        // test body
        $result = Layer::existingFileGetContents(__FILE__);

        // assertions
        $this->assertStringContainsString('ExistingFileGetContentsUnitTest', $result);
    }

    /**
     * Testing exception while getting existing file
     */
    public function testExceptionWhileGettingFileContentReal(): void
    {
        // assertions
        $this->expectException(\Exception::class);
        $this->expectExceptionCode(- 1);
        $this->expectExceptionMessage('File unexisting does not exists');

        // setup
        Conf::setConfigValue('fs/layer', 'real');

        // test body
        Layer::existingFileGetContents('unexisting');
    }
}
