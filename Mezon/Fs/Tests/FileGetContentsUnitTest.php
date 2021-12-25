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
class FileGetContentsUnitTest extends TestCase
{

    /**
     * Testing method fileGetContents
     */
    public function testFileGetContents(): void
    {
        // setup
        Conf::setConfigValue('fs/layer', 'mock');
        InMemory::filePutContents('existing', 'data');

        // test body and assertions
        $this->assertEquals('data', Layer::fileGetContents('existing'));
        $this->assertEquals(false, Layer::fileGetContents('unexisting'));
    }
}
