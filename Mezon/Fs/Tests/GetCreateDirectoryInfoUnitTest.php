<?php
namespace Mezon\Fs\Tests;

use PHPUnit\Framework\TestCase;
use Mezon\Fs\Layer;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class GetCreateDirectoryInfoUnitTest extends TestCase
{

    /**
     * Testing exception
     */
    public function testException(): void
    {
        // assertions
        // TODO add to the template these three directives
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Element with key 0 was not found');
        $this->expectExceptionCode(- 1);

        // setup
        Layer::clearCreatedDirectoriesInfo();

        // test body
        Layer::getCreatedDirectoryInfo(0);
    }
}
