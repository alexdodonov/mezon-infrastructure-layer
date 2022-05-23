<?php
namespace Mezon\Headers\Tests;

use PHPUnit\Framework\TestCase;
use Mezon\Headers;
use Mezon\Conf\Conf;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class HeadersUnitTest extends TestCase
{

    /**
     * Testing method getAllHeaders
     */
    public function testGetAllHeaders(): void
    {
        // setup
        Conf::setConfigStringValue('headers/layer', 'mock');
        Headers\Layer::setAllHeaders([
            'header' => 'value'
        ]);

        // test body
        $headers = Headers\Layer::getAllHeaders();

        // assertions
        $this->assertCount(1, $headers);
        $this->assertArrayHasKey('header', $headers);
        $this->assertTrue(in_array('value', $headers));
    }

    /**
     * Testing method addHeader
     */
    public function testAddHeader(): void
    {
        // setup
        Conf::setConfigStringValue('headers/layer', 'mock');
        Headers\Layer::setAllHeaders([]);

        // test body
        Headers\Layer::addHeader('name', 'value');

        // assertions
        $this->assertArrayHasKey('name', Headers\Layer::getAllHeaders());
        $this->assertTrue(in_array('value', Headers\Layer::getAllHeaders()));
    }
}
