<?php
namespace Mezon\Fs\Tests;

use PHPUnit\Framework\TestCase;
use Mezon\Conf\Conf;
use Mezon\Fs\Layer;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class FileExistsUnitTest extends TestCase
{

    /**
     * Testing method fileExists
     */
    public function testFileExists(): void
    {
        // setup
        Conf::setConfigValue('fs/layer', 'mock');
        Layer::$fileExisting = [
            true,
            false,
            true
        ];

        // test body and assertions
        $this->assertTrue(Layer::fileExists('path-true'));
        $this->assertFalse(Layer::fileExists('path-false'));
        $this->assertTrue(Layer::fileExists('path-true'));
    }
}
