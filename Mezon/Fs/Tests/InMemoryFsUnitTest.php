<?php
namespace Mezon\Fs\Tests;

use PHPUnit\Framework\TestCase;
use Mezon\Fs\InMemory;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class InMemoryFsUnitTest extends TestCase
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
     * Testing methods fileGetContentns
     */
    public function testFileGetContents(): void
    {
        // test body
        InMemory::filePutContents('./path', 'data');

        // assertions
        $this->assertEquals('data', InMemory::fileGetContents('./path'));
    }

    /**
     * Testing methods fileGetContentns for unexisting file
     */
    public function testFileGetContentsOfUnexistingFile(): void
    {
        // test body and assertions
        $this->assertFalse(InMemory::fileGetContents('./unexisting'));
    }

    /**
     * Testing methods filePutContentns with appending data
     */
    public function testFileAppendContents(): void
    {
        // test body
        InMemory::filePutContents('./path', 'a', FILE_APPEND);
        InMemory::filePutContents('./path', 'b', FILE_APPEND);

        // assertions
        $this->assertEquals('ab', InMemory::fileGetContents('./path'));
    }

    /**
     * Testing method filePutContents with infection
     */
    public function testFilePutContentsWithException(): void
    {
        // assertions
        $this->expectException(\Exception::class);
        $this->expectExceptionCode(- 1);
        $this->expectExceptionMessage('Undefined flags : 3');

        // test body
        InMemory::filePutContents('./path', 'b', 3);
    }

    /**
     * Testing method filePutContents with infection
     */
    public function testFilePutContentsWithExceptionNegative(): void
    {
        // assertions
        $this->expectException(\Exception::class);
        $this->expectExceptionCode(- 1);
        $this->expectExceptionMessage('Undefined flags : -2');

        // test body
        InMemory::filePutContents('./path', 'b', - 2);
    }

    /**
     * Testing exception in existringFileGetContents
     */
    public function testExistringFileGetContentsException(): void
    {
        // assertions
        $this->expectException(\Exception::class);
        $this->expectExceptionCode(- 1);
        $this->expectExceptionMEssage('File ./unexisting does not exists');

        // test body
        InMemory::existingFileGetContents('./unexisting');
    }
}
