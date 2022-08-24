<?php

namespace Noodlehaus\Parser\Test;

use Noodlehaus\Parser\Serialize;
use PHPUnit\Framework\TestCase;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-04-21 at 22:37:22.
 */
class SerializeTest extends TestCase
{
    /**
     * @var Serialize
     */
    protected $serialize;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->serialize = new Serialize();
    }

    /**
     * @covers Noodlehaus\Parser\Serialize::getSupportedExtensions()
     */
    public function testGetSupportedExtensions()
    {
        $expected = ['txt'];
        $actual   = $this->serialize->getSupportedExtensions();
        $this->assertSame($expected, $actual);
    }

    /**
     * @covers                   Noodlehaus\Parser\Serialize::parseFile()
     * @covers                   Noodlehaus\Parser\Serialize::parse()
     */
    public function testLoadInvalidSerialize()
    {
        $this->expectException(\Noodlehaus\Exception\ParseException::class);
        $this->expectExceptionMessage('unserialize(): Error at offset 57 of 58 bytes');
        $this->serialize->parseFile(__DIR__ . '/../mocks/fail/error.txt');
    }

    /**
     * @covers Noodlehaus\Parser\Serialize::parseFile()
     * @covers Noodlehaus\Parser\Serialize::parseString()
     * @covers Noodlehaus\Parser\Serialize::parse()
     */
    public function testLoadSerialize()
    {
        $file = $this->serialize->parseFile(__DIR__ . '/../mocks/pass/config.txt');
        $string = $this->serialize->parseString(file_get_contents(__DIR__ . '/../mocks/pass/config.txt'));

        $this->assertSame('localhost', $file['host']);
        $this->assertSame(80, $file['port']);

        $this->assertSame('localhost', $string['host']);
        $this->assertSame(80, $string['port']);
    }
}
