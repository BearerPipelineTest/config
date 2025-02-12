<?php

namespace Noodlehaus\Parser\Test;

use Noodlehaus\Parser\Json;
use PHPUnit\Framework\TestCase;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-04-21 at 22:37:22.
 */
class JsonTest extends TestCase
{
    /**
     * @var Json
     */
    protected $json;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->json = new Json();
    }

    /**
     * @covers Noodlehaus\Parser\Json::getSupportedExtensions()
     */
    public function testGetSupportedExtensions()
    {
        $expected = ['json'];
        $actual   = $this->json->getSupportedExtensions();
        $this->assertSame($expected, $actual);
    }

    /**
     * @covers                   Noodlehaus\Parser\Json::parseFile()
     * @covers                   Noodlehaus\Parser\Json::parse()
     */
    public function testLoadInvalidJson()
    {
        $this->expectException(\Noodlehaus\Exception\ParseException::class);
        $this->expectExceptionMessage('Syntax error');
        $this->json->parseFile(__DIR__ . '/../mocks/fail/error.json');
    }

    /**
     * @covers Noodlehaus\Parser\Json::parseFile()
     * @covers Noodlehaus\Parser\Json::parseString()
     * @covers Noodlehaus\Parser\Json::parse()
     */
    public function testLoadJson()
    {
        $file = $this->json->parseFile(__DIR__ . '/../mocks/pass/config.json');
        $string = $this->json->parseString(file_get_contents(__DIR__ . '/../mocks/pass/config.json'));

        $this->assertSame('localhost', $file['host']);
        $this->assertSame(80, $file['port']);

        $this->assertSame('localhost', $string['host']);
        $this->assertSame(80, $string['port']);
    }
}
