<?php
namespace Mezon\Fs\Tests;

use PHPUnit\Framework\TestCase;
use Mezon\Conf\Conf;
use Mezon\Fs\Layer;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class FileGetContentsUnitTest extends TestCase
{

    /**
     * Testing method
     */
    public function testFileGetContents(): void
    {
        // setup
        Conf::setConfigValue('fs/layer', 'mock');
        Layer::$fileGetContentsData = [
            'existing' => 'data',
            'unexisting' => false
        ];

        // test body and assertions
        $this->assertEquals('data', Layer::fileGetContents('existing'));
        $this->assertEquals(false, Layer::fileGetContents('unexisting'));
    }
}
