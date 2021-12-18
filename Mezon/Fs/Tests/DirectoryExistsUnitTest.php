<?php
namespace Mezon\Fs\Tests;

use PHPUnit\Framework\TestCase;
use Mezon\Conf\Conf;
use Mezon\Fs\Layer;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class DirectoryExistsUnitTest extends TestCase
{

    /**
     * Testing method directoryExists
     */
    public function testDirectoryExists(): void
    {
        // setup
        Conf::setConfigValue('fs/layer', 'mock');
        Layer::$createdDirectories[] = [
            'path' => 'existing'
        ];

        // test body and assertions
        $this->assertTrue(Layer::directoryExists('existing'));
        $this->assertFalse(Layer::directoryExists('unexisting'));
    }
}
