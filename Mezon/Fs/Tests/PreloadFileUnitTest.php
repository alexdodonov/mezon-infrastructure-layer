<?php
namespace Mezon\Fs\Tests;

use PHPUnit\Framework\TestCase;
use Mezon\Fs\InMemory;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class PreloadFileUnitTest extends TestCase
{

    /**
     * Testing exception
     */
    public function testException(): void
    {
        // assertions
        $this->expectException(\Exception::class);
        $this->expectExceptionCode(- 1);
        $this->expectExceptionMessage('File ./unexisting was not found');

        // test body
        InMemory::preloadFile('./unexisting');
    }
}
